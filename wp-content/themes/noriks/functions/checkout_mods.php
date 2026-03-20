<?php
<<<<<<< HEAD



/**
 * Force Billing and Shipping Country to GR for all WooCommerce orders
 */
add_action( 'woocommerce_checkout_create_order', function( $order, $data ) {

    // Set billing country
    $order->set_billing_country( 'IT' );

    // Set shipping country
    $order->set_shipping_country( 'IT' );

}, 20, 2 );




// 1) Tell Woo’s default chooser to prefer COD when available.
add_filter('default_checkout_payment_method', function($method, $available_gateways) {
    return isset($available_gateways['cod']) ? 'cod' : $method;
}, 10, 2);

// 2) On first render (no prior choice in session), set COD as chosen.
add_action('woocommerce_before_checkout_form', function () {
    if (is_admin() && !defined('DOING_AJAX')) {
        return;
    }
    if (!function_exists('WC') || !WC()->session) {
        return;
    }

    $chosen = WC()->session->get('chosen_payment_method');
    if (empty($chosen)) {
        $available = WC()->payment_gateways()->get_available_payment_gateways();
        if (isset($available['cod'])) {
            WC()->session->set('chosen_payment_method', 'cod');
        }
    }
}, 5);

/**
 * Optional (front-end safety net):
 * If your theme/JS wipes the selection on first paint, precheck COD once.
 * Remove this block if you don’t need it.
 */
add_action('wp_footer', function () {
    if (!is_checkout() || is_wc_endpoint_url('order-received')) {
        return;
    } ?>
    <script>
    jQuery(function($){
        var $checked = $('input[name="payment_method"]:checked');
        if (!$checked.length && $('#payment_method_cod').length) {
            $('#payment_method_cod').prop('checked', true).trigger('change');
        }
    });
    </script>
<?php });


//  we need to move order now button bellow shop table on mobile only


/**
 * Move WooCommerce "Place order" button after the order review table on mobile only.
 * We hide the default button (only the button, not payments) and print our own copy later.
 */
add_action( 'wp', function () {

    // Only on the checkout page (not the thank-you page) and only on mobile.
    if ( ! function_exists( 'is_checkout' ) || ! is_checkout() || ( function_exists( 'is_order_received_page' ) && is_order_received_page() ) ) {
        return;
    }
    if ( ! function_exists( 'wp_is_mobile' ) || ! wp_is_mobile() ) {
        return;
    }

    // 1) Suppress only the default "Place order" button output.
    add_filter( 'woocommerce_order_button_html', 'mytheme_hide_default_place_order_button', 999 );

    // 2) Re-output a button after the order review table.
    add_action( 'woocommerce_checkout_after_order_review', 'mytheme_mobile_place_order_button_after_review', 20 );
});

/**
 * Filter callback to hide the default button.
 */
function mytheme_hide_default_place_order_button( $html ) {
    return '';
}

/**
 * Our custom button after the order review table (inside the checkout form).
 */
function mytheme_mobile_place_order_button_after_review() {

    // Use WooCommerce’s default translatable text (filters will still run on the TEXT, which is safe).
    $order_button_text = apply_filters(
        'woocommerce_order_button_text',
        __( 'Place order', 'woocommerce' )
    );

    // IMPORTANT: do NOT pass this HTML back through 'woocommerce_order_button_html' (it would be blanked).
    echo sprintf(
        '<button type="submit" class="button alt" name="woocommerce_checkout_place_order" id="place_order" value="%1$s" data-value="%1$s">%2$s</button>',
        esc_attr( $order_button_text ),
        esc_html( $order_button_text )
    );
}






//  we need to move order now button bellow shop table on mobile only












add_action( 'wp', function() {
    // Remove coupon form from its default location
    remove_action( 'woocommerce_before_checkout_form', 'woocommerce_checkout_coupon_form', 10 );

    // Add coupon form after order review
   // add_action( 'woocommerce_review_order_after_order_total', 'woocommerce_checkout_coupon_form' );
});





add_filter('woocommerce_billing_fields', 'no_billing_phone_validation' );
function no_billing_phone_validation( $fields ) {
    $fields['billing_phone']['required'] = true;
    return $fields;
}

// we hide ship to different address
add_filter( 'woocommerce_cart_needs_shipping_address', '__return_false' );


// we hide order extra notes
add_filter( 'woocommerce_checkout_fields', 'remove_order_notes_field' );
function remove_order_notes_field( $fields ) {
    if ( isset( $fields['order']['order_comments'] ) ) {
        unset( $fields['order']['order_comments'] );
    }
    return $fields;
}



// Move email field to top of billing fields
/*
add_filter( 'woocommerce_checkout_fields', 'custom_move_email_field_first', 20, 1 );
function custom_move_email_field_first( $fields ) {
    if ( isset( $fields['billing']['billing_email'] ) ) {
        $fields['billing']['billing_email']['priority'] = 1; // Ensure it's first
    }
    return $fields;
}
*/


add_filter( 'woocommerce_checkout_fields', 'custom_checkout_reorder_fields' );
function custom_checkout_reorder_fields( $fields ) {
    // Email first
    if ( isset( $fields['billing']['billing_email'] ) ) {
        $fields['billing']['billing_email']['priority'] = 1;
    }
    
      // Email first
    if ( isset( $fields['billing']['billing_phone'] ) ) {
        $fields['billing']['billing_phone']['priority'] = 2;
    }

    // Country next
    if ( isset( $fields['billing']['billing_country'] ) ) {
        $fields['billing']['billing_country']['priority'] = 5;
    }

    // First name
    if ( isset( $fields['billing']['billing_first_name'] ) ) {
        $fields['billing']['billing_first_name']['priority'] = 10;
    }

    // Last name
    if ( isset( $fields['billing']['billing_last_name'] ) ) {
        $fields['billing']['billing_last_name']['priority'] = 20;
    }



     // Ensure address_1 has a priority before address_2
    if ( isset( $fields['billing']['billing_address_1'] ) ) {
        $fields['billing']['billing_address_1']['priority'] = 40;
        $fields['billing']['billing_address_1']['required'] = true; // Keep it required
    }




    // Make sure address_2 exists, is visible, and ordered correctly
    if ( isset( $fields['billing']['billing_address_2'] ) ) {
        $fields['billing']['billing_address_2']['priority'] = 45; // Just after address_1
        $fields['billing']['billing_address_2']['required'] = false; // Usually optional
        $fields['billing']['billing_address_2']['class'] = array( 'form-row-wide' );
        
          $fields['billing']['billing_address_1']['label'] = __( 'Via/Piazza', 'your-textdomain' );
        
        
        $fields['billing']['billing_address_2']['label'] = __( 'Numero Civico', 'your-textdomain' );
        $fields['billing']['billing_address_2']['placeholder'] = __( 'Kućni broj', 'your-textdomain' );
        $fields['billing']['billing_address_2']['required'] = true; // Keep it required
    }





    return $fields;
}



add_filter( 'woocommerce_checkout_required_field_notice', function( $error, $field_label ) {
    // Remove "Naplata " prefix from the error message
    // Example input: "Naplata Mobitel (primjer: 0912345678)"
    $clean_label = preg_replace( '/^Naplata\s*/i', '', $field_label );

    // Rebuild WooCommerce's required field message
    $error = sprintf( __( '%s je obavezno polje.', 'woocommerce' ), $clean_label );

    return $error;
}, 10, 2 );

// Output a heading above the email field
add_action( 'woocommerce_before_checkout_billing_form', 'add_contact_heading_before_email' );
function add_contact_heading_before_email() {

    
    echo '<h3 class="checkout-section-title">I tuoi dati</h3>';
}


add_filter( 'woocommerce_checkout_fields', 'move_labels_to_placeholders' );
function move_labels_to_placeholders( $fields ) {
    foreach ( $fields as $section_key => $section ) {
        foreach ( $section as $field_key => $field ) {
            if ( isset( $fields[$section_key][$field_key]['label'] ) ) {
                $fields[$section_key][$field_key]['placeholder'] = $fields[$section_key][$field_key]['label'];
                $fields[$section_key][$field_key]['label'] = '';
            }
        }
    }
    return $fields;
}


// Remove default payment section
remove_action( 'woocommerce_checkout_order_review', 'woocommerce_checkout_payment', 20 );

// Re-add payment section right after billing fields
add_action( 'woocommerce_checkout_after_customer_details', 'woocommerce_checkout_payment', 5 );







add_filter( 'woocommerce_checkout_cart_item_quantity', 'add_product_image_to_checkout_review', 10, 3 );
function add_product_image_to_checkout_review( $product_name, $cart_item, $cart_item_key ) {
    if ( is_checkout() ) {
        $product = $cart_item['data'];
        $thumbnail = $product->get_image( [ 40, 40 ], [ 'style' => 'margin-right:10px; vertical-align:middle;' ] );

        // Wrap in span or div for better layout control
        return '<span  style="order: 1; display: flex; align-items: center;">' . $thumbnail . '<span>' . $product_name . '</span></span>';
    }

    return $product_name;
}


add_action( 'woocommerce_checkout_create_order', 'copy_billing_to_shipping_after_order', 10, 2 );
function copy_billing_to_shipping_after_order( $order, $data ) {
    // Copy each billing field to the shipping field
    $fields = [
        'first_name',
        'last_name',
        'company',
        'address_1',
        'address_2',
        'city',
        'state',
        'postcode',
        'country',
        'phone',
    ];

    foreach ( $fields as $field ) {
        $billing_value = $order->{"get_billing_$field"}();
        $order->{"set_shipping_$field"}( $billing_value );
    }
}




add_filter( 'woocommerce_gateway_description', 'remove_payment_method_description', 20, 2 );
function remove_payment_method_description( $description, $payment_id ) {
    return ''; // Return empty description
}



add_filter( 'woocommerce_cart_shipping_method_full_label', 'custom_shipping_label_price_only', 10, 2 );
function custom_shipping_label_price_only( $label, $method ) {
    if ( is_checkout() ) {
        // Get only the cost formatted
        $price = wc_price( $method->cost + array_sum( $method->get_taxes() ) );

        return $price; // Output just the price, like "2,99 €"
    }

    return $label; // Keep default elsewhere (e.g., cart)
}





add_filter( 'woocommerce_package_rates', 'auto_select_and_hide_paid_shipping_when_free', 100, 2 );
function auto_select_and_hide_paid_shipping_when_free( $rates, $package ) {
    $free = [];

    foreach ( $rates as $rate_id => $rate ) {
        if ( 'free_shipping' === $rate->method_id ) {
            $free[ $rate_id ] = $rate;
            break; // only need one free method
        }
    }

    return ! empty( $free ) ? $free : $rates;
}
=======
/**
 * Checkout Modifications — Vigoshop CDN CSS + WC field config
 * Works WITHIN WooCommerce checkout system (no template bypass)
 */
if ( ! defined( 'ABSPATH' ) ) exit;

/**
 * Dequeue ALL WP/WC/theme styles on checkout, load vigoshop CDN CSS
 */
add_action( 'wp_enqueue_scripts', function() {
    if ( ! is_checkout() ) return;

    // Remove ALL registered styles except admin-bar
    global $wp_styles;
    if ( ! empty( $wp_styles->registered ) ) {
        foreach ( array_keys( $wp_styles->registered ) as $handle ) {
            if ( $handle !== 'admin-bar' && $handle !== 'dashicons' ) {
                wp_deregister_style( $handle );
            }
        }
    }

    // Remove ALL registered scripts except essential WC ones
    global $wp_scripts;
    $keep_scripts = array(
        'jquery', 'jquery-core', 'jquery-migrate',
        'wc-checkout', 'woocommerce', 'wc-country-select', 'wc-address-i18n',
        'selectWoo', 'wc-jquery-blockui', 'wc-js-cookie',
        'wp-hooks', 'wp-i18n',
    );
    if ( ! empty( $wp_scripts->registered ) ) {
        foreach ( array_keys( $wp_scripts->registered ) as $handle ) {
            if ( ! in_array( $handle, $keep_scripts, true ) ) {
                wp_deregister_script( $handle );
            }
        }
    }

    // Vigoshop CDN CSS — exact same files + order as /test-checkout/
    $css = array(
        'vigo-select2'           => 'https://vigoshop.hr/app/plugins/woocommerce/assets/css/select2.css',
        'vigo-brands'            => 'https://vigoshop.hr/app/plugins/woocommerce/assets/css/brands.css',
        'vigo-child'             => 'https://vigoshop.hr/app/themes/hsplus-child/style.css',
        'vigo-app'               => 'https://vigoshop.hr/app/themes/hsplus/dist/app-bb7116ca22.css',
        'vigo-swiper'            => 'https://vigoshop.hr/app/themes/hsplus/assets/plugins/swiper/swiper.min.css',
        'vigo-brand'             => 'https://vigoshop.hr/app/themes/hsplus/dist/vigoshop-2809b8fc43.css',
        'vigo-agent-kc'          => 'https://vigoshop.hr/app/plugins/core/resources/dist/css/agent-kc/css/agent-kc-d24968c5d8.css',
        'vigo-cart-warranty'     => 'https://vigoshop.hr/app/plugins/core/resources/dist/css/cart-warranty/css/cart-warranty-294993db14.css',
        'vigo-checkout-triggers' => 'https://vigoshop.hr/app/plugins/core/resources/dist/css/checkout-extra-triggers/css/checkout-extra-triggers-8a82c39c7f.css',
        'vigo-checkout-general'  => 'https://vigoshop.hr/app/plugins/core/resources/dist/css/checkout-validation/css/custom-checkout-general-3ba2df51f0.css',
        'vigo-checkout-hr'       => 'https://vigoshop.hr/app/plugins/core/resources/dist/css/checkout-validation/css/custom-checkout-hr-708bf051cd.css',
        'vigo-payment-notice'    => 'https://vigoshop.hr/app/plugins/core/resources/dist/css/custom-payment-notice/css/custom-payment-notice-0baf6bff40.css',
        'vigo-header'            => 'https://vigoshop.hr/app/plugins/core/resources/dist/css/header/css/header-f98b75e0d2.css',
        'vigo-shop-elements'     => 'https://vigoshop.hr/app/plugins/core/resources/dist/css/homepage-shop-elements/css/general-shop-elements-a82fb8d5a2.css',
        'vigo-payment-fixes'     => 'https://vigoshop.hr/app/plugins/core/resources/dist/css/payment-methods-fixes/css/payment-methods-fixes-75bc076f0b.css',
        'vigo-checkout-review'   => 'https://vigoshop.hr/app/plugins/core/resources/dist/css/checkout-order-review/css/checkout-order-review-17423b66f5.css',
        'vigo-checkout-upsell'   => 'https://vigoshop.hr/app/plugins/core/resources/dist/css/checkout-upsell/css/checkout-upsell-49a595b20c.css',
        'vigo-shipping'          => 'https://vigoshop.hr/app/plugins/core/resources/dist/css/shipping-method/css/shipping-method-14ad2b0a1f.css',
        'vigo-parcel'            => 'https://vigoshop.hr/app/plugins/core/resources/dist/css/parcel-pickup/css/parcel-pickup-hr-8754cf5c08.css',
        'vigo-parcel-buttons'    => 'https://vigoshop.hr/app/plugins/core/resources/dist/css/parcel-pickup/css/extra-shipping-method-buttons-093d5c786e.css',
        'vigo-pdf'               => 'https://vigoshop.hr/app/plugins/core/resources/dist/css/pdf-products/css/pdf-products-2009e19a3b.css',
        'vigo-pdf-special'       => 'https://vigoshop.hr/app/plugins/core/resources/dist/css/pdf-products/css/pdf-special-offer-545e3ee266.css',
        'vigo-terms'             => 'https://vigoshop.hr/app/plugins/core/resources/dist/css/terms-and-conditions-link/css/terms-and-conditions-link-4d809e8b6d.css',
        'vigo-email-checkbox'    => 'https://vigoshop.hr/app/plugins/core/resources/dist/css/email-checkbox-subscription/css/email-checkbox-subscription-1def327263.css',
        'vigo-free-shipping'     => 'https://vigoshop.hr/app/plugins/core/resources/dist/css/free-shipping-above-quantity/css/free-shipping-above-quantity-02588a20ff.css',
        'vigo-loader'            => 'https://vigoshop.hr/app/plugins/core/resources/dist/css/loader/css/loader-c25fc35077.css',
        'vigo-check-client'      => 'https://vigoshop.hr/app/plugins/core/resources/dist/css/check-client/css/check-client-8571deb0ef.css',
    );

    $prev = array();
    foreach ( $css as $handle => $url ) {
        wp_enqueue_style( $handle, $url, $prev, null );
        $prev = array( $handle );
    }

    // Our checkout override CSS — LAST
    $dir = get_template_directory();
    $uri = get_template_directory_uri();
    $file = $dir . '/css/checkout.css';
    wp_enqueue_style( 'noriks-checkout', $uri . '/css/checkout.css', $prev, file_exists($file) ? md5_file($file) : '1' );

}, 9999 );

/**
 * Also dequeue styles that get enqueued late (after priority 9999)
 */
add_action( 'wp_print_styles', function() {
    if ( ! is_checkout() ) return;
    // Remove any storefront/theme CSS that snuck through
    $remove = array( 'storefront-style', 'storefront-woocommerce-style', 'storefront-gutenberg-blocks', 'wp-block-library' );
    foreach ( $remove as $h ) wp_dequeue_style( $h );
}, 9999 );

/**
 * Inline styles from vigoshop <head>
 */
add_action( 'wp_head', function() {
    if ( ! is_checkout() ) return;
    echo '<style>tr.cart-discount.coupon-get1free .amount{display:none;}</style>';
    echo '<style>img:is([sizes="auto" i],[sizes^="auto," i]){contain-intrinsic-size:3000px 1500px}</style>';
    echo '<style>.woocommerce form .form-row .required{visibility:visible;}</style>';
}, 5 );

/**
 * CSS-only overrides — injected AFTER all CDN CSS to guarantee winning specificity
 * SAFE: no script/style dequeuing, purely additive CSS
 */
add_action( 'wp_footer', function() {
    if ( ! is_checkout() ) return;
    ?>
    <style id="noriks-checkout-overrides">
    /* ===== PAYMENT: duplicate #payment vigoshop styles for #noriks-payment ===== */
    /* Payment title — vigoshop CDN hides it, force show */
    body.woocommerce-checkout h3.payment-title {
      display: block !important;
      font-size: 19.6px !important;
      font-weight: 700 !important;
      margin: 29.4px 0 14.7px !important;
      color: #333 !important;
    }
    /* Payment methods list */
    #noriks-payment .wc_payment_methods {
      list-style: none !important;
      padding: 0 !important;
      margin: 0 0 21px !important;
    }
    /* Payment method items */
    #noriks-payment .wc_payment_method {
      list-style: none !important;
      padding: 0 !important;
      margin: 0 !important;
      border: 1px solid #d1dbe5 !important;
      border-radius: 5px 5px 0 0 !important;
    }
    #noriks-payment .wc_payment_method + .wc_payment_method {
      border-radius: 0 !important;
      border-top: none !important;
    }
    #noriks-payment .wc_payment_method:last-child {
      border-radius: 0 0 5px 5px !important;
      border-bottom: 1px solid #d1dbe5 !important;
    }
    /* Selected payment = blue bg */
    #noriks-payment .wc_payment_method:has(input:checked) {
      background: #e8f3ff !important;
    }
    /* Radio inputs hidden (vigoshop uses label as the clickable area) */
    #noriks-payment .wc_payment_method .input-radio {
      display: none !important;
    }
    /* Payment labels — exact vigoshop computed styles */
    #noriks-payment .wc_payment_method label {
      display: flex !important;
      align-items: center !important;
      padding: 22.65px 16px !important;
      margin: 0 !important;
      font-size: 16px !important;
      font-weight: 500 !important;
      color: #333 !important;
      line-height: 24px !important;
      cursor: pointer !important;
    }
    #noriks-payment .wc_payment_method:has(input:checked) label {
      font-weight: 700 !important;
    }
    /* Fee badges */
    #noriks-payment .payment-fee-free {
      display: block !important;
      padding: 3px 10px !important;
      margin: 2px 0 2px 8px !important;
      border-radius: 5px !important;
      background: #9ce79c !important;
      color: #228b22 !important;
      font-size: 14px !important;
      font-weight: 500 !important;
      text-align: center !important;
      line-height: 21px !important;
    }
    #noriks-payment .payment-fee-not-free {
      display: block !important;
      padding: 3px 10px !important;
      margin: 2px 0 2px 8px !important;
      border-radius: 5px !important;
      background: #e3e6e8 !important;
      color: #5f6061 !important;
      font-size: 14px !important;
      font-weight: 500 !important;
      text-align: center !important;
      line-height: 21px !important;
    }
    /* Card icons */
    #noriks-payment .sv-wc-payment-gateway-card-icons {
      display: flex !important;
      align-items: center !important;
      margin-left: auto !important;
      gap: 4px !important;
    }
    #noriks-payment .sv-wc-payment-gateway-icon {
      width: 40px !important;
      height: 25px !important;
    }
    /* COD icon */
    #noriks-payment .hs-checkout__payment-method-cod-icon-container {
      display: flex !important;
      align-items: center !important;
      margin-left: auto !important;
    }
    #noriks-payment .hs-checkout__payment-method-cod-icon {
      height: 30px !important;
    }
    /* PayPal icon */
    #noriks-payment .payment_method_braintree_paypal label img {
      margin-left: auto !important;
      height: 22px !important;
    }

    /* ===== ORDER SUMMARY ===== */
    .vigo-checkout-total .review-section-container {
      display: flex !important;
      align-items: center !important;
      padding: 0 0 10px !important;
      margin: 0 0 10px !important;
      border-bottom: 1px solid #e3e6e8 !important;
      color: #5f6061 !important;
      font-size: 14px !important;
      line-height: 21px !important;
      position: relative !important;
    }
    .vigo-checkout-total .review-product-info {
      display: flex !important;
      flex: 1 !important;
      min-width: 0 !important;
    }
    .vigo-checkout-total .review-product-info > div:first-child {
      white-space: nowrap !important;
      overflow: hidden !important;
      text-overflow: ellipsis !important;
    }
    .vigo-checkout-total .info-price {
      text-align: right !important;
      min-width: 60px !important;
      white-space: nowrap !important;
      flex-shrink: 0 !important;
    }
    .vigo-checkout-total .review-product-remove {
      width: 0 !important;
      display: none !important;
    }
    .vigo-checkout-total__sum {
      padding: 25px 0 0 !important;
      color: #232f3e !important;
    }
    .vigo-checkout-total__sum .f--bold,
    .vigo-checkout-total__sum .price_total_wrapper {
      font-weight: 700 !important;
      color: #232f3e !important;
    }

    /* ===== FIELD DESCRIPTIONS (helper text under inputs) ===== */
    body.woocommerce-checkout .form-row .description {
      display: flex !important;
      justify-content: flex-end !important;
      font-size: 13px !important;
      color: #5f6061 !important;
      margin-top: 6px !important;
      line-height: 1.4 !important;
    }
    body.woocommerce-checkout .form-row .description .desc-left {
      margin-right: auto !important;
      text-align: left !important;
    }
    body.woocommerce-checkout .form-row .description .desc-right {
      text-align: right !important;
    }

    /* ===== SHIPPING METHOD — force show (vigoshop CSS hides, JS shows) ===== */
    #custom_shipping .shipping_method_custom {
      display: block !important;
    }
    #custom_shipping .shipping_method_custom li {
      display: list-item !important;
      list-style: none !important;
      margin: 0 0 3px !important;
    }
    #custom_shipping .shipping_method_custom label,
    #custom_shipping .checkedlabel {
      display: flex !important;
      align-items: center !important;
      background: #f2feee !important;
      border: 1px solid #47b426 !important;
      border-radius: 5px !important;
      padding: 10px 15px !important;
      cursor: pointer !important;
    }
    #custom_shipping .outer-wrapper {
      display: flex !important;
      align-items: center !important;
      justify-content: space-between !important;
      flex: 1 !important;
    }
    #custom_shipping .inner-wrapper-dates {
      display: block !important;
    }
    #custom_shipping .hs-custom-date {
      display: inline !important;
      font-weight: 700 !important;
      font-size: 14px !important;
    }
    #custom_shipping .inner-wrapper-img {
      display: flex !important;
      align-items: center !important;
      gap: 8px !important;
    }
    #custom_shipping .shipping_method_delivery_price {
      display: block !important;
      background: #9ce79c !important;
      color: #228b22 !important;
      border-radius: 5px !important;
      padding: 0 10.5px !important;
      margin: 5px 0 !important;
      font-size: 14px !important;
      font-weight: 500 !important;
      line-height: 21px !important;
    }
    #custom_shipping .delivery_img img {
      height: 30px !important;
    }
    #custom_shipping .shipping_method_field {
      display: none !important;
    }
    #custom_shipping label svg {
      width: 19px !important;
      height: 14px !important;
      margin-right: 10px !important;
      flex-shrink: 0 !important;
    }

    /* ===== BUTTON/WARRANTY/TERMS — match form padding ===== */
    body.woocommerce-checkout #order_review,
    body.woocommerce-checkout .checkout-warranty,
    body.woocommerce-checkout .agreed_terms_txt {
      padding-left: 40px !important;
      padding-right: 40px !important;
      box-sizing: border-box !important;
    }
    @media (max-width: 560px) {
      body.woocommerce-checkout #order_review,
      body.woocommerce-checkout .checkout-warranty,
      body.woocommerce-checkout .agreed_terms_txt {
        padding-left: 15px !important;
        padding-right: 15px !important;
      }
    }
    /* Warranty margin — set below with button */
    /* Terms margin matches ref */
    body.woocommerce-checkout .agreed_terms_txt {
      margin-bottom: 24px !important;
    }
    /* Button container — tight to content above */
    body.woocommerce-checkout #order_review {
      max-width: none !important;
      margin: 0 !important;
      padding-top: 0 !important;
    }
    /* Remove form bottom padding that creates gap above button */
    body.woocommerce-checkout form.checkout {
      padding-bottom: 10px !important;
    }
    /* Tighten place-order section bottom */
    body.woocommerce-checkout .form-row.place-order {
      margin-bottom: 0 !important;
      padding-bottom: 0 !important;
    }
    /* Warranty tighter to button */
    body.woocommerce-checkout .checkout-warranty {
      margin-top: 20px !important;
      margin-bottom: 16px !important;
    }

    /* ===== FIELD VALIDATION STATES ===== */
    /* Override WC default validation styles so ours always win */
    body.woocommerce-checkout .form-row.noriks-invalid.woocommerce-validated input,
    body.woocommerce-checkout .form-row.noriks-invalid.woocommerce-validated select,
    body.woocommerce-checkout .form-row.noriks-invalid.woocommerce-validated .select2-selection,
    /* Error state — white bg, red border */
    body.woocommerce-checkout .form-row.noriks-invalid input,
    body.woocommerce-checkout .form-row.noriks-invalid select,
    body.woocommerce-checkout .form-row.noriks-invalid .select2-selection {
      border: 2px solid #CC0000 !important;
      background-color: #fff !important;
      box-shadow: none !important;
    }
    /* Error message — pink block under input */
    body.woocommerce-checkout .noriks-field-error {
      display: block !important;
      background: #FDE8E8 !important;
      color: #CC0000 !important;
      font-size: 13px !important;
      font-weight: 500 !important;
      padding: 8px 12px !important;
      margin-top: 4px !important;
      border-radius: 4px !important;
      line-height: 1.4 !important;
    }
    /* Valid state — green border, light green bg */
    body.woocommerce-checkout .form-row.noriks-valid input,
    body.woocommerce-checkout .form-row.noriks-valid select,
    body.woocommerce-checkout .form-row.noriks-valid .select2-selection {
      border: 2px solid #4CAF50 !important;
      background-color: #E8F5E9 !important;
      box-shadow: none !important;
    }
    /* Valid label turns green */
    body.woocommerce-checkout .form-row.noriks-valid > label {
      color: #4CAF50 !important;
    }
    /* Valid checkmark inside input */
    body.woocommerce-checkout .form-row.noriks-valid .woocommerce-input-wrapper {
      position: relative !important;
    }
    body.woocommerce-checkout .form-row.noriks-valid .woocommerce-input-wrapper::after {
      content: '\2713' !important;
      position: absolute !important;
      right: 16px !important;
      top: 50% !important;
      transform: translateY(-50%) !important;
      color: #4CAF50 !important;
      font-size: 20px !important;
      font-weight: 700 !important;
      pointer-events: none !important;
    }
    </style>

    <script id="noriks-checkout-validation">
    jQuery(function($){
      var messages = {
        required: '\u2715 Obavezna informacija',
        billing_address_2: '\u2715 Ukoliko nemate kućni broj upišite BB',
      };
      var submitted = false; /* only validate after first submit attempt */

      function showError($row, msg) {
        $row.removeClass('noriks-valid woocommerce-validated').addClass('noriks-invalid woocommerce-invalid');
        if (!$row.find('.noriks-field-error').length) {
          $row.append('<span class="noriks-field-error">' + msg + '</span>');
        } else {
          $row.find('.noriks-field-error').text(msg);
        }
      }

      function showValid($row) {
        $row.removeClass('noriks-invalid woocommerce-invalid').addClass('noriks-valid woocommerce-validated');
        $row.find('.noriks-field-error').remove();
      }

      function clearState($row) {
        $row.removeClass('noriks-invalid noriks-valid woocommerce-invalid woocommerce-validated');
        $row.find('.noriks-field-error').remove();
      }

      function validateField(field, force) {
        var $row = $(field).closest('.form-row');
        var id = $row.attr('id') || '';
        var val = $(field).val()?.trim() || '';
        var isRequired = $row.hasClass('validate-required');
        var isEmail = $row.hasClass('validate-email');
        var isPhone = $row.hasClass('validate-phone');

        /* Only validate after first submit click */
        if (!submitted && !force) return true;

        /* Skip non-required empty fields */
        if (!isRequired && !val) { clearState($row); return true; }

        /* Required check */
        if (isRequired && !val) {
          showError($row, messages[id.replace('_field','')] || messages.required);
          return false;
        }

        /* Email format */
        if (isEmail && val && !/^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(val)) {
          showError($row, '\u2715 Εισαγάγετε έγκυρη διεύθυνση email');
          return false;
        }

        /* Phone format (at least 6 digits) */
        if (isPhone && val && val.replace(/\D/g,'').length < 6) {
          showError($row, '\u2715 Εισαγάγετε έγκυρο αριθμό τηλεφώνου');
          return false;
        }

        /* Valid */
        if (val) showValid($row);
        return true;
      }

      /* Re-validate on input/change — clears error when value becomes valid */
      $(document).on('input', '.woocommerce-checkout .form-row input', function(){
        if (submitted) validateField(this);
      });
      $(document).on('change', '.woocommerce-checkout .form-row select', function(){
        if (submitted) validateField(this);
      });

      /* Block WC's own validate_field from overriding our validation states */
      $(document.body).on('validate_field', function(e, el){
        var $el = $(el);
        var $row = $el.closest('.form-row');
        if ($row.hasClass('noriks-invalid') || $row.hasClass('noriks-valid')) {
          e.stopImmediatePropagation();
          return false;
        }
      });

      /* Re-apply validation after WC AJAX updates (update_checkout replaces DOM) */
      $(document.body).on('updated_checkout', function(){
        if (!submitted) return;
        $('.woocommerce-checkout .form-row.validate-required').each(function(){
          var input = $(this).find('input, select').first();
          if (input.length) validateField(input[0]);
        });
      });

      /* Remove ALL existing click handlers on submit button, then bind ours */
      var $btn = $('#noriks_place_order');
      $btn.off('click');
      /* Also clone-replace to remove handlers bound before .off() could run */
      var $newBtn = $btn.clone(false);
      $btn.replaceWith($newBtn);

      /* Validate all on submit — first time sets submitted=true */
      $newBtn.on('click', function(e){
        e.preventDefault();
        e.stopImmediatePropagation();
        submitted = true;
        var allValid = true;
        $('.woocommerce-checkout .form-row.validate-required').each(function(){
          var input = $(this).find('input, select').first();
          if (input.length && !validateField(input[0], true)) allValid = false;
        });
        if (!allValid) {
          var first = $('.noriks-invalid:first');
          if (first.length) $('html,body').animate({scrollTop: first.offset().top - 100}, 300);
          return false;
        }
        /* All valid — trigger WC checkout submit */
        $('#place_order').trigger('click');
      });
    });
    </script>
    <?php
}, 50 );

/**
 * Body classes — vigoshop expects these
 */
add_filter( 'body_class', function( $classes ) {
    if ( is_checkout() ) {
        $classes[] = 'brand-vigoshop';
        $classes[] = 'theme-vigoshop';
        $classes[] = 'theme-hsplus';
        $classes[] = 'wp-child-theme-hsplus-child';
    }
    return $classes;
});

/**
 * WC checkout field config — match vigoshop HR layout
 */
add_filter( 'woocommerce_checkout_fields', function( $fields ) {
    // Order — match vigoshop: name → address → phone → email
    $fields['billing']['billing_phone']['priority']       = 10;
    $fields['billing']['billing_email']['priority']       = 20;
    $fields['billing']['billing_first_name']['priority']  = 30;
    $fields['billing']['billing_last_name']['priority']   = 40;
    $fields['billing']['billing_address_1']['priority']   = 50;
    $fields['billing']['billing_address_2']['priority']   = 60;
    $fields['billing']['billing_postcode']['priority']    = 70;
    $fields['billing']['billing_city']['priority']        = 80;
    // phone/email priorities already set above (10/20)

    // Labels, placeholders, required
    $fields['billing']['billing_first_name']['label'] = 'Όνομα';
    $fields['billing']['billing_first_name']['placeholder'] = 'Όνομα';
    $fields['billing']['billing_last_name']['label'] = 'Επώνυμο';
    $fields['billing']['billing_last_name']['placeholder'] = 'Επώνυμο';
    $fields['billing']['billing_address_1']['label'] = 'Οδός';
    $fields['billing']['billing_address_1']['placeholder'] = 'Οδός';
    $fields['billing']['billing_address_2']['label'] = 'Αριθμός';
    $fields['billing']['billing_address_2']['placeholder'] = 'Αριθμός';
    $fields['billing']['billing_address_2']['required'] = true;
    $fields['billing']['billing_postcode']['label'] = 'Ταχυδρομικός κώδικας';
    $fields['billing']['billing_postcode']['placeholder'] = 'Ταχυδρομικός κώδικας';
    $fields['billing']['billing_city']['label'] = 'Πόλη';
    $fields['billing']['billing_city']['placeholder'] = 'Επιλέξτε πόλη';
    $fields['billing']['billing_phone']['label'] = 'Τηλέφωνο';
    $fields['billing']['billing_phone']['placeholder'] = 'Broj mobilnog telefona';
    $fields['billing']['billing_phone']['description'] = '<span class="desc-left">Παράδειγμα: 6912345678</span><span class="desc-right">Για βοήθεια με την αποστολή</span>';
    $fields['billing']['billing_email']['label'] = 'E-mail adresa';
    $fields['billing']['billing_email']['placeholder'] = 'E-mail adresa';
    $fields['billing']['billing_email']['description'] = 'Για επιβεβαίωση παραγγελίας και παρακολούθηση αποστολής';
    $fields['billing']['billing_email']['required'] = false;
    $fields['billing']['billing_country']['default'] = 'GR';
    unset( $fields['billing']['billing_company'] );

    // Vigoshop CSS classes
    $fields['billing']['billing_first_name']['class'] = array('form-row','form-row-first','form-group','col-xs-12','validate-required');
    $fields['billing']['billing_last_name']['class']  = array('form-row','form-row-last','form-group','col-xs-12','validate-required');
    $fields['billing']['billing_address_1']['class']  = array('form-row','form-row-wide','address-field','form-group','col-xs-12','validate-required');
    $fields['billing']['billing_address_2']['class']  = array('form-row','form-row-wide','address-field','form-group','col-xs-12','validate-required');
    $fields['billing']['billing_postcode']['class']   = array('form-row','form-row-wide','address-field','form-group','col-xs-12','validate-required','validate-postcode');
    $fields['billing']['billing_city']['class']       = array('form-row','form-row-wide','dropdown','form-group','col-xs-12','validate-required');
    $fields['billing']['billing_phone']['class']      = array('form-row','form-row-wide','form-group','col-xs-12','validate-required','validate-phone');
    $fields['billing']['billing_email']['class']      = array('form-row','form-row-wide','form-group','col-xs-12','validate-email');

    // Input class — vigoshop uses 'form-input' alongside WC's 'input-text'
    foreach ( $fields['billing'] as &$f ) {
        $f['input_class'] = array( 'input-text', 'form-input' );
    }

    return $fields;
}, 20 );

/**
 * Address hint after last name
 */
add_filter( 'woocommerce_form_field_text', function( $field, $key ) {
    if ( $key === 'billing_last_name' ) {
        $field .= '<div class="form-row form-row-wide col-xs-12">Εισαγάγετε τη διεύθυνση όπου θα βρίσκεστε <b>μεταξύ 8:00 και 16:00</b>.</div>';
    }
    return $field;
}, 10, 2 );

/**
 * Billing title
 */
add_action( 'woocommerce_before_checkout_billing_form', function() {
    echo '<h3 class="checkout-billing-title">Πληρωμή και Αποστολή</h3>';
});

add_filter( 'default_checkout_billing_country', function() { return 'GR'; });
add_filter( 'woocommerce_order_button_text', function() { return 'Παραγγελία'; });

/**
 * Payment gateway order: COD → Stripe → PayPal
 */
add_filter( 'woocommerce_available_payment_gateways', function( $gw ) {
    $order = array('cod','stripe_cc','ppcp-gateway');
    $sorted = array();
    foreach ( $order as $id ) { if ( isset($gw[$id]) ) $sorted[$id] = $gw[$id]; }
    foreach ( $gw as $id => $g ) { if ( !isset($sorted[$id]) ) $sorted[$id] = $g; }
    return $sorted;
}, 100 );

add_filter( 'woocommerce_enable_order_notes_field', '__return_false' );

/**
 * Disable coupons on checkout entirely
 */
add_filter( 'woocommerce_coupons_enabled', function( $enabled ) {
    if ( is_checkout() ) return false;
    return $enabled;
});

/**
 * Remove info-banner from checkout page content
 */
add_filter( 'the_content', function( $content ) {
    if ( is_checkout() ) {
        $content = preg_replace( '/<section class="info-banner">.*?<\/section>/s', '', $content );
    }
    return $content;
}, 999 );
>>>>>>> 65cb868516d40f3fcbaffd3799194a6a5a8cbd7f
