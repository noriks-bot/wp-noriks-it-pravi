<?php
/**
 * OrderCloner Class File
 *
 * Handles the cloning and duplicating of WooCommerce orders.
 *
 * @package CDO_WC
 */

namespace CDO_WC;

use WC_Order_Item_Product;
use WC_Order_Item_Shipping;
use WC_Order_Item_Coupon;
use WC_Order;

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Class OrderCloner
 *
 * Handles the cloning and duplicating of WooCommerce orders.
 */
class CDO_WC_Cloner {

	/**
	 * Constructor.
	 *
	 * Initializes the plugin by setting up actions and filters.
	 */
	public function __construct() {
		// Enqueue custom CSS and JS.
		add_action( 'admin_enqueue_scripts', array( $this, 'enqueue_assets' ) );

		// Show the Actions column by default (runs after WooCommerce's filter with priority 11).
		add_filter( 'default_hidden_columns', array( $this, 'show_actions_column_by_default' ), 11, 2 );

		// Add the clone button to the orders index page.
		add_filter( 'woocommerce_admin_order_actions_end', array( $this, 'add_clone_order_action_button' ) );

		// Handle the clone order action.
		add_action( 'wp_ajax_clone_order', array( $this, 'handle_clone_order_action' ) );

		// Add Clone Order to woocommerce order action.
		add_action( 'woocommerce_order_action_clone_order', array( $this, 'handle_woocommerce_clone_order_action' ) );
		add_action( 'woocommerce_order_actions', array( $this, 'add_clone_to_order_actions_dropdown' ), 10, 1 ); // @phpstan-ignore return.void

		// Add meta box to the order edit and create pages.
		add_action( 'add_meta_boxes', array( $this, 'add_meta_box_to_order_screen' ) );

		// Add an action to display the admin notice.
		add_action( 'admin_notices', array( $this, 'admin_notices' ) );

		// Add site health check.
		add_filter( 'debug_information', array( $this, 'add_to_site_health' ) );
	}

	/**
	 * Enqueue assets.
	 */
	public function enqueue_assets() {
		wp_enqueue_style(
			'cdo-wc-admin-css',
			esc_url( CDO_WC_ASSETS_URL . 'css/cdo-wc-main.css' ),
			array(),
			CDO_WC_VERSION_NUM
		);
	}

	/**
	 * Show the Actions column by default on WooCommerce orders list.
	 *
	 * This filter runs after WooCommerce's default_hidden_columns filter (priority 10)
	 * to ensure the wc_actions column is visible by default, making the clone button accessible.
	 *
	 * @param array  $hidden Array of column IDs that are hidden by default.
	 * @param object $screen The current screen object.
	 * @return array Modified array of hidden columns.
	 */
	public function show_actions_column_by_default( $hidden, $screen ) {
		// Check if we're on the orders list screen (both classic and HPOS).
		$order_screen_ids = array( 'edit-shop_order', 'woocommerce_page_wc-orders' );

		if ( ! isset( $screen->id ) || ! in_array( $screen->id, $order_screen_ids, true ) ) {
			return $hidden;
		}

		// Remove wc_actions from the hidden columns array to show it by default.
		if ( is_array( $hidden ) ) {
			$hidden = array_diff( $hidden, array( 'wc_actions' ) );
		}

		return $hidden;
	}

	/**
	 * Add meta box to single order screen.
	 */
	public function add_meta_box_to_order_screen() {
		$screen          = get_current_screen();
		$order_screen_id = CDO_WC_Checks::hpos_status() ? 'woocommerce_page_wc-orders' : 'shop_order';
		$order_id        = get_the_ID();
		$order           = wc_get_order( $order_id );

		if ( CDO_WC_Checks::check_permission() && $screen && $screen->id === $order_screen_id && $order && 'auto-draft' !== $order->get_status() ) {
			add_meta_box(
				'order_meta_box',
				'Clone Order',
				array( $this, 'add_clone_button_to_meta_box' ),
				$order_screen_id,
				'side',
				'core'
			);
		}
	}

	/**
	 * Add the clone order button on the single order page inside metabox.
	 *
	 * @param WC_Order $order The order object.
	 */
	public function add_clone_button_to_meta_box( $order ) {
		$order_id = CDO_WC_Checks::hpos_status() ? $order->get_id() : $order->ID;  // @phpstan-ignore property.notFound
		$order    = wc_get_order( $order_id );

		if ( $order ) {
			$nonce = wp_create_nonce( 'clone_order_nonce' );
			$url   = admin_url( 'admin-ajax.php?action=clone_order&order_id=' . $order_id . '&_wpnonce=' . $nonce );
			echo '<a href="' . esc_url( $url ) . '" class="button clone_single_order_button cdo-wc-order-clone-prevent-duplicate-js" title="' . esc_attr__( 'Clone Order', 'clone-duplicate-orders-for-woocommerce' ) . '">' . esc_html__( 'Clone Order', 'clone-duplicate-orders-for-woocommerce' ) . '</a>';
			$this->prevent_multiple_submissions_js();
			do_action( 'cdo_wc_add_custom_clone_button', $order_id );
		} else {
			echo '<p>' . esc_html__( 'Clone is not available for this order.', 'clone-duplicate-orders-for-woocommerce' ) . '</p>';
		}
	}

	/**
	 * Adds a 'Clone order' action to the WooCommerce order actions dropdown.
	 *
	 * @param array $actions The existing order actions.
	 * @return array Modified order actions.
	 */
	public function add_clone_to_order_actions_dropdown( $actions ) {
		$order_id = get_the_ID();
		$order    = wc_get_order( $order_id );

		if ( ! $order || 'auto-draft' === $order->get_status() ) {
			return $actions;
		}

		if ( CDO_WC_Checks::check_permission() ) {
			if ( is_array( $actions ) ) {
				$actions['clone_order'] = esc_html__( 'Clone order', 'clone-duplicate-orders-for-woocommerce' );
			}
		}
		return $actions;
	}

	/**
	 * Add the clone order action button on the orders index page.
	 *
	 * @param WC_Order $order The order object.
	 */
	public function add_clone_order_action_button( $order ) {
		$order_id = $order->get_id();
		$nonce    = wp_create_nonce( 'clone_order_nonce' );
		echo '<a class="button wc-action-button wc-action-button-clone tips cdo-wc-order-clone-prevent-duplicate-js" href="' . esc_url( admin_url( 'admin-ajax.php?action=clone_order&order_id=' . $order_id . '&_wpnonce=' . $nonce ) ) . '" data-tip="' . esc_attr__( 'Clone Order', 'clone-duplicate-orders-for-woocommerce' ) . '">' . esc_html__( 'Clone Order', 'clone-duplicate-orders-for-woocommerce' ) . '</a>';
		$this->prevent_multiple_submissions_js();
	}

	/**
	 * Handle the clone_order action.
	 */
	public function handle_clone_order_action() {
		if ( ! CDO_WC_Checks::check_permission() ) {
			wp_die( esc_html__( 'You do not have permission to clone orders.', 'clone-duplicate-orders-for-woocommerce' ) );
		}

		if ( isset( $_GET['order_id'] ) && isset( $_GET['_wpnonce'] ) ) {
			$order_id = intval( wp_unslash( $_GET['order_id'] ) );
			$nonce    = sanitize_text_field( wp_unslash( $_GET['_wpnonce'] ) );

			if ( wp_verify_nonce( $nonce, 'clone_order_nonce' ) ) {
				if ( get_transient( 'cdo_wc_cloning_order_' . $order_id ) ) {
					$redirect_url  = admin_url( 'edit.php?post_type=shop_order' );
					$delay_seconds = 5;
					echo '<div style="text-align:center;margin-top:20px;">';
					echo '<p>' . esc_html__( 'This order is already being cloned, and we have detected multiple clicks. You will be redirected to the orders page shortly.', 'clone-duplicate-orders-for-woocommerce' ) . '</p>';
					/* translators: %1$ is number of seconds. %2$ is the word here that links to orders index. */
					echo '<p>' . sprintf( esc_html__( 'If you are not redirected within %1$d seconds, click %2$s.', 'clone-duplicate-orders-for-woocommerce' ), esc_html( (string) $delay_seconds ), '<a href="' . esc_url( $redirect_url ) . '">' . esc_html__( 'here', 'clone-duplicate-orders-for-woocommerce' ) . '</a>' ) . '</p>';
					echo '</div>';

					add_action(
						'admin_footer',
						function () use ( $redirect_url, $delay_seconds ) {
							wp_register_script( 'cdo_wc_clonning_redirect', '', array(), CDO_WC_VERSION_NUM, true );
							wp_enqueue_script( 'cdo_wc_clonning_redirect' );

							$inline_script = '
								setTimeout(function(){
									window.location.href = "' . esc_url( $redirect_url ) . '";
								}, ' . (int) ( $delay_seconds * 1000 ) . ');
							';
							wp_add_inline_script( 'cdo_wc_clonning_redirect', $inline_script );
						}
					);

					wp_die();
				}
				set_transient( 'cdo_wc_cloning_order_' . $order_id, true, 30 );

				$new_order_id = $this->duplicate_order( $order_id );

				if ( false === $new_order_id ) {
					delete_transient( 'cdo_wc_cloning_order_' . $order_id );
					wp_die( esc_html__( 'Failed to clone the order. Please try again.', 'clone-duplicate-orders-for-woocommerce' ) );
				}

				$new_order_url = admin_url( 'post.php?post=' . $new_order_id . '&action=edit' );
				$redirect_url  = wp_get_referer() ? wp_get_referer() : admin_url();

				$message = $this->get_success_message( $new_order_url, $new_order_id );

				set_transient( 'cdo_wc_clone_order_admin_notice', $message, 30 );
				delete_transient( 'cdo_wc_cloning_order_' . $order_id );
				wp_safe_redirect( esc_url_raw( $redirect_url ) );
				exit;
			}
		} else {
			wp_die( esc_html__( 'Nonce verification failed or order ID not set.', 'clone-duplicate-orders-for-woocommerce' ) );
		}
	}

	/**
	 * Handle the clone order action.
	 *
	 * @param WC_Order $order The order object.
	 */
	public function handle_woocommerce_clone_order_action( $order ) {
		if ( ! CDO_WC_Checks::check_permission() ) {
			wp_die( esc_html__( 'You do not have permission to clone orders.', 'clone-duplicate-orders-for-woocommerce' ) );
		}

		$order_id     = $order->get_id();
		$new_order_id = $this->duplicate_order( $order_id );

		if ( false === $new_order_id ) {
			wp_die( esc_html__( 'Failed to clone the order. Please try again.', 'clone-duplicate-orders-for-woocommerce' ) );
		}

		$new_order_url = admin_url( 'post.php?post=' . $new_order_id . '&action=edit' );
		$redirect_url  = wp_get_referer() ? wp_get_referer() : admin_url();

		$message = $this->get_success_message( $new_order_url, $new_order_id );

		set_transient( 'cdo_wc_clone_order_admin_notice', $message, 30 );
		wp_safe_redirect( esc_url_raw( $redirect_url ) );
		exit;
	}

	/**
	 * Get success message for order duplication
	 *
	 * @param string $new_order_url URL of the new order.
	 * @param int    $new_order_id  ID of the new order.
	 * @return string Success message.
	 */
	private function get_success_message( $new_order_url, $new_order_id ) {
		return sprintf(
			wp_kses(
				/* translators: %1$s: New order URL, %2$d: New order ID, %3$s: View the cloned order URL */
				__( 'Order successfully duplicated. New order ID: <a href="%1$s">#%2$d</a>. <a href="%3$s">View the cloned order</a>', 'clone-duplicate-orders-for-woocommerce' ),
				array( 'a' => array( 'href' => array() ) )
			),
			esc_url( $new_order_url ),
			intval( $new_order_id ),
			esc_url( $new_order_url )
		);
	}

	/**
	 * Duplicate an order.
	 *
	 * @param int $original_order_id Original order ID.
	 * @return int|false New order ID on success, false on failure.
	 */
	public function duplicate_order( $original_order_id ) {
		if ( ! is_numeric( $original_order_id ) || $original_order_id <= 0 ) {
			return false;
		}

		$original_order = wc_get_order( $original_order_id );
		if ( ! $original_order ) {
			return false;
		}

		try {
			// Disable all WooCommerce order status emails.
			add_filter( 'woocommerce_email_enabled_new_order', '__return_false' );
			add_filter( 'woocommerce_email_enabled_cancelled_order', '__return_false' );
			add_filter( 'woocommerce_email_enabled_failed_order', '__return_false' );
			add_filter( 'woocommerce_email_enabled_customer_on_hold_order', '__return_false' );
			add_filter( 'woocommerce_email_enabled_customer_processing_order', '__return_false' );
			add_filter( 'woocommerce_email_enabled_customer_completed_order', '__return_false' );
			add_filter( 'woocommerce_email_enabled_customer_refunded_order', '__return_false' );
			add_filter( 'woocommerce_email_enabled_customer_invoice', '__return_false' );

			$option_fields       = get_option( 'cdo_wc_acf_option_fields', array() );
			$option_field_values = array();

			if ( $option_fields ) {
				foreach ( $option_fields as $name => $label ) {
					$option_field_values[ $name ] = get_option( $name );
				}
			}

			/**
			 * Filters the default order status for cloned orders.
			 *
			 * @since 1.0.8
			 *
			 * @param string $status Default order status for cloned orders.
			 * @param int $original_order_id The ID of the original order being cloned.
			 * @param WC_Order $original_order The original order object being cloned.
			 */
			$clone_order_status = apply_filters( 'cdo_wc_clone_order_status', 'pending', $original_order_id, $original_order ); // phpcs:ignore WPOrgSubmissionRules.Naming.UniqueName.MissingPrefix

			// Validate order status is a valid WooCommerce status.
			$valid_statuses = array_keys( wc_get_order_statuses() );
			// Remove 'wc-' prefix from valid statuses for comparison.
			$valid_statuses = array_map(
				function ( $status ) {
					return str_replace( 'wc-', '', $status );
				},
				$valid_statuses
			);

			if ( ! in_array( $clone_order_status, $valid_statuses, true ) ) {
				$clone_order_status = 'pending'; // Fallback to default if invalid.
			}

			/**
			 * Filters whether to copy the customer note from the original order.
			 *
			 * @since 1.0.8
			 *
			 * @param string $customer_note The customer note from the original order.
			 * @param int $original_order_id The ID of the original order being cloned.
			 * @param WC_Order $original_order The original order object being cloned.
			 */
			$clone_customer_note = apply_filters( 'cdo_wc_clone_customer_note', $original_order->get_customer_note(), $original_order_id, $original_order );

			$order_data = array(
				'customer_id'   => $original_order->get_user_id(), // phpcs:ignore WPOrgSubmissionRules.Naming.UniqueName.MissingPrefix
				'status'        => $clone_order_status,
				'currency'      => $original_order->get_currency(),
				'billing'       => $original_order->get_address( 'billing' ),
				'shipping'      => $original_order->get_address( 'shipping' ),
				'customer_note' => $clone_customer_note,
			);

			/**
			 * Create new order instance.
			 *
			 * @var \WC_Order|false|\WP_Error $order
			 */
			$order = wc_create_order( $order_data );

			if ( ! $order || is_wp_error( $order ) ) {
				return false;
			}

			$ignore_meta_keys = array(
				'_payment_method',
				'_payment_method_title',
				'_transaction_id',
				'_paid_date',
				'_payment_tokens',
				'_paypal_transaction_id',
				'_paypal_status',
				'_clover_charge_id',
				'_clover_order_id',
				'_order_number',
				'_wcpdf_invoice_number',
				'_wcpdf_invoice_number_data',
				'_wcdn_invoice_number',
				'wf_invoice_number',

				// Transaction-binding identifiers.
				'_stripe_intent_id',
				'_stripe_charge_id',
				'_stripe_balance_transaction',
				'_stripe_mandate',

				// Per-charge financials.
				'_stripe_fee',
				'_stripe_net',
				'_stripe_total_fee',
				'_stripe_total_net',
				'_stripe_currency',

				// Stored method & customer bindings.
				'_stripe_customer_id',
				'_stripe_source_id',
				'_stripe_card_id',
				'_stripe_upe_saved_payment_method',
				'_stripe_payment_method_type',

				// Misc flags.
				'_stripe_mode',
				'_stripe_charge_captured',
			);

			/**
			 * Filters the list of meta keys to ignore when cloning an order.
			 *
			 * This filter allows developers to add or remove meta keys that should not be
			 * copied when cloning an order. By default, payment-related and invoice-related
			 * meta keys are excluded for security reasons.
			 *
			 * @since 1.0.7
			 *
			 * @param array $ignore_meta_keys Array of meta keys to ignore during order cloning.
			 * @param int   $original_order_id The ID of the original order being cloned.
			 * @param WC_Order $original_order The original order object being cloned.
			 *
			 * @return array Modified array of meta keys to ignore.
			 */
			$filtered_ignore_meta_keys = apply_filters( 'cdo_wc_clone_order_ignore_meta_keys', $ignore_meta_keys, $original_order_id, $original_order );

			// Ensure the filtered value is an array for security.
			if ( ! is_array( $filtered_ignore_meta_keys ) ) {
				$filtered_ignore_meta_keys = $ignore_meta_keys;
			}

			$ignore_meta_keys = $filtered_ignore_meta_keys;

			foreach ( $original_order->get_meta_data() as $meta ) {
				// Skip payment-related meta data.
				if ( in_array( $meta->key, $ignore_meta_keys, true ) ) {
					continue;
				}

				// Check if this meta key should be cloned.
				if ( array_key_exists( $meta->key, $option_field_values ) && 'no' === $option_field_values[ $meta->key ] ) {
					$order->delete_meta_data( $meta->key );
					continue;
				}

				$order->update_meta_data( $meta->key, $meta->value );
			}

			// Handle payment information based on the ignore list.
			$payment_method       = in_array( '_payment_method', $ignore_meta_keys, true ) ? '' : $original_order->get_payment_method();
			$payment_method_title = in_array( '_payment_method_title', $ignore_meta_keys, true ) ? '' : $original_order->get_payment_method_title();
			$transaction_id       = in_array( '_transaction_id', $ignore_meta_keys, true ) ? '' : $original_order->get_transaction_id();

			$order->set_payment_method( $payment_method );
			$order->set_payment_method_title( $payment_method_title );
			$order->set_transaction_id( $transaction_id );

			/**
			 * Filters whether to use current product prices instead of original order prices.
			 *
			 * By default, cloned orders use the prices from the original order. Set this to true
			 * to use the current product prices at the time of cloning.
			 *
			 * @since 1.0.8
			 *
			 * @param bool $use_current_price Whether to use current product prices. Default false.
			 * @param int $original_order_id The ID of the original order being cloned.
			 * @param WC_Order $original_order The original order object being cloned.
			 */
			$use_current_price = apply_filters( 'cdo_wc_clone_use_current_price', false, $original_order_id, $original_order );

			/**
			 * Filters whether to check product stock before adding to cloned order.
			 *
			 * By default, cloned orders include all products regardless of stock status.
			 * Set this to true to skip out-of-stock products.
			 *
			 * @since 1.0.8
			 *
			 * @param bool $check_stock Whether to check stock status. Default false.
			 * @param int $original_order_id The ID of the original order being cloned.
			 * @param WC_Order $original_order The original order object being cloned.
			 */
			$check_stock = apply_filters( 'cdo_wc_clone_check_stock', false, $original_order_id, $original_order );

			foreach ( $original_order->get_items() as $item ) {
				if ( $item->get_type() === 'line_item' ) {
					$product = $item->get_product();
					if ( $product ) {
						// Skip out-of-stock products if stock checking is enabled.
						if ( $check_stock && ! $product->is_in_stock() ) {
							continue;
						}

						$new_item = new WC_Order_Item_Product();
						$new_item->set_product_id( $item->get_product_id() );
						$new_item->set_variation_id( $item->get_variation_id() );
						$new_item->set_name( $item->get_name() );
						$new_item->set_quantity( $item->get_quantity() );

						// Handle pricing option - use current price or original price.
						if ( $use_current_price ) {
							// Use current product price excluding tax and let calculate_totals() handle taxes.
							// Using wc_get_price_excluding_tax() prevents double taxation when calculate_totals() runs.
							$current_price = (float) wc_get_price_excluding_tax( $product );
							$quantity      = $item->get_quantity();
							$subtotal      = $current_price * $quantity;
							$new_item->set_subtotal( (string) $subtotal );
							$new_item->set_total( (string) $subtotal );
							// Clear tax amounts so calculate_totals() can recalculate them.
							$new_item->set_subtotal_tax( '0' );
							$new_item->set_total_tax( '0' );
							$new_item->set_taxes(
								array(
									'total'    => array(),
									'subtotal' => array(),
								)
							);
						} else {
							// Use original order prices.
							$new_item->set_subtotal( (string) $item->get_subtotal() );
							$new_item->set_total( (string) $item->get_total() );
						}

						// Preserve tax class from original item so calculate_totals() applies correct tax.
						$new_item->set_tax_class( $item->get_tax_class() );

						// Copy item meta.
						foreach ( $item->get_meta_data() as $meta ) {
							$new_item->add_meta_data( $meta->key, $meta->value, true );
						}

						$order->add_item( $new_item );
					}
				} else {
					$order->add_item( clone $item );
				}
			}

			// Clone or set new shipping method based on the setting.
			foreach ( $original_order->get_items( 'shipping' ) as $shipping_item ) {
				$new_shipping_item = new WC_Order_Item_Shipping();
				$new_shipping_item->set_method_title( $shipping_item->get_method_title() );
				$new_shipping_item->set_method_id( $shipping_item->get_method_id() );
				$new_shipping_item->set_total( $shipping_item->get_total() );
				$new_shipping_item->set_taxes( $shipping_item->get_taxes() );

				foreach ( $shipping_item->get_meta_data() as $meta ) {
					$new_shipping_item->add_meta_data( $meta->key, $meta->value, true );
				}

				$order->add_item( $new_shipping_item );
			}

			// Coupon items.
			foreach ( $original_order->get_items( 'coupon' ) as $coupon_item ) {
				$new_coupon_item = new WC_Order_Item_Coupon();
				$new_coupon_item->set_code( $coupon_item->get_code() );
				$new_coupon_item->set_discount( $coupon_item->get_discount() );
				$order->add_item( $new_coupon_item );
			}

			$order->calculate_totals();
			$order->update_status( $clone_order_status );
			$order->set_address( $order_data['billing'], 'billing' );
			$order->set_address( $order_data['shipping'], 'shipping' );

			/**
			 * Filters the date to use for the cloned order.
			 *
			 * By default, cloned orders use the current date/time. Return a date string
			 * in MySQL format (Y-m-d H:i:s) or pass the original order's date.
			 *
			 * @since 1.0.8
			 *
			 * @param string $date_created Date string in MySQL format. Default is current time.
			 * @param int $original_order_id The ID of the original order being cloned.
			 * @param WC_Order $original_order The original order object being cloned.
			 */
			$clone_date = apply_filters( 'cdo_wc_clone_date_created', current_time( 'mysql' ), $original_order_id, $original_order );

			// Validate date format (Y-m-d H:i:s).
			if ( ! preg_match( '/^\d{4}-\d{2}-\d{2} \d{2}:\d{2}:\d{2}$/', $clone_date ) ) {
				$clone_date = current_time( 'mysql' ); // Fallback to current time if invalid.
			}

			// Set the order's date created.
			$order->set_date_created( $clone_date );

			/**
			 * Filters the note added to the cloned order.
			 *
			 * @since 1.0.8
			 *
			 * @param string $note The note to add to the cloned order.
			 * @param int $original_order_id The ID of the original order being cloned.
			 * @param WC_Order $original_order The original order object being cloned.
			 * @param WC_Order $order The new cloned order object.
			 */
			$clone_note = apply_filters( 'cdo_wc_clone_order_note', sprintf( 'This order was duplicated from order %d.', $original_order_id ), $original_order_id, $original_order, $order );

			if ( ! empty( $clone_note ) ) {
				$order->add_order_note( $clone_note );
			}

			$order->save();

			/**
			 * Action hook fired after an order has been successfully cloned.
			 *
			 * @since 1.0.8
			 *
			 * @param int $new_order_id The ID of the newly created cloned order.
			 * @param int $original_order_id The ID of the original order that was cloned.
			 * @param WC_Order $order The new cloned order object.
			 * @param WC_Order $original_order The original order object.
			 */
			do_action( 'cdo_wc_after_order_cloned', $order->get_id(), $original_order_id, $order, $original_order );

			do_action( 'woocommerce_new_order', $order->get_id(), $order ); // phpcs:ignore WPOrgSubmissionRules.Naming.UniqueName.MissingPrefix

			// Enable all WooCommerce order status emails.
			remove_filter( 'woocommerce_email_enabled_new_order', '__return_false' );
			remove_filter( 'woocommerce_email_enabled_cancelled_order', '__return_false' );
			remove_filter( 'woocommerce_email_enabled_failed_order', '__return_false' );
			remove_filter( 'woocommerce_email_enabled_customer_on_hold_order', '__return_false' );
			remove_filter( 'woocommerce_email_enabled_customer_processing_order', '__return_false' );
			remove_filter( 'woocommerce_email_enabled_customer_completed_order', '__return_false' );
			remove_filter( 'woocommerce_email_enabled_customer_refunded_order', '__return_false' );
			remove_filter( 'woocommerce_email_enabled_customer_invoice', '__return_false' );

			return $order->get_id();
		} catch ( \Exception $e ) {
			remove_filter( 'woocommerce_email_enabled_new_order', '__return_false' );
			remove_filter( 'woocommerce_email_enabled_cancelled_order', '__return_false' );
			remove_filter( 'woocommerce_email_enabled_failed_order', '__return_false' );
			remove_filter( 'woocommerce_email_enabled_customer_on_hold_order', '__return_false' );
			remove_filter( 'woocommerce_email_enabled_customer_processing_order', '__return_false' );
			remove_filter( 'woocommerce_email_enabled_customer_completed_order', '__return_false' );
			remove_filter( 'woocommerce_email_enabled_customer_refunded_order', '__return_false' );
			remove_filter( 'woocommerce_email_enabled_customer_invoice', '__return_false' );

			return false;
		}
	}

	/**
	 * Add sites options and information to Site Health
	 *
	 * @param array $args Arguments.
	 * @return array
	 */
	public function add_to_site_health( array $args ): array {
		$fields = array(
			'is_hpos_enabled' => array(
				'label' => esc_html__( 'HPOS Status', 'clone-duplicate-orders-for-woocommerce' ),
				'value' => CDO_WC_Checks::hpos_status() ? 'enabled' : 'disabled',
			),
		);

		$option_fields = get_option( 'cdo_wc_acf_option_fields', array() );

		if ( $option_fields ) {
			foreach ( $option_fields as $key => $value ) {
				$label          = ucwords( str_replace( '_', ' ', $key ) );
				$fields[ $key ] = array(
					'label' => esc_html( $label ),
					'value' => esc_html( get_option( $key ) ),
				);
			}
		}

		$args['cdo_wc_clone_orders'] = array(
			'label'  => esc_html__( 'Clone / Duplicate Orders for WooCommerce', 'clone-duplicate-orders-for-woocommerce' ), // phpcs:ignore WPOrgSubmissionRules.Naming.UniqueName.MissingPrefix
			'fields' => $fields,
		);

		return $args;
	}

	/**
	 * Prevent multiple form submissions. This code is inlined to make sure it always works.
	 *
	 * @return void
	 */
	private function prevent_multiple_submissions_js() {
		wp_register_script( 'cdo_wc_prevent_duplicate_submissions', '', array( 'jquery' ), CDO_WC_VERSION_NUM, true );
		wp_enqueue_script( 'cdo_wc_prevent_duplicate_submissions' );

		$inline_script = "
			jQuery(document).ready(function($) {
				$('.cdo-wc-order-clone-prevent-duplicate-js').on('click', function(e) {
					var \$this = $(this);
					\$this.css('opacity', '0.4').addClass('disabled');
					e.preventDefault();
					if (\$this.data('clicked')) {
						return false;
					}
					\$this.data('clicked', true);
					window.location.href = \$this.attr('href');
				});
			});
		";

		wp_add_inline_script( 'cdo_wc_prevent_duplicate_submissions', $inline_script );
	}

	/**
	 * Handle the admin notice after duplicating.
	 */
	public function admin_notices() {
		$notice = get_transient( 'cdo_wc_clone_order_admin_notice' );

		if ( $notice ) {
			?>
			<div class="notice notice-success is-dismissible">
				<p><?php echo wp_kses_post( $notice ); ?></p>
			</div>
			<?php
			delete_transient( 'cdo_wc_clone_order_admin_notice' );
		}
	}
}
