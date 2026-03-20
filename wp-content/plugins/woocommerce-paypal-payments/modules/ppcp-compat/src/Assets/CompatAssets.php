<?php

/**
 * Register and configure assets for Compat module.
 *
 * @package WooCommerce\PayPalCommerce\Compat\Assets
 */
declare (strict_types=1);
namespace WooCommerce\PayPalCommerce\Compat\Assets;

use WooCommerce\PayPalCommerce\ApiClient\Authentication\Bearer;
<<<<<<< HEAD
=======
use WooCommerce\PayPalCommerce\Assets\AssetGetter;
>>>>>>> 65cb868516d40f3fcbaffd3799194a6a5a8cbd7f
use WooCommerce\PayPalCommerce\OrderTracking\TrackingAvailabilityTrait;
/**
 * Class OrderEditPageAssets
 */
class CompatAssets
{
    use TrackingAvailabilityTrait;
<<<<<<< HEAD
    /**
     * The URL to the module.
     *
     * @var string
     */
    private $module_url;
=======
    private AssetGetter $asset_getter;
>>>>>>> 65cb868516d40f3fcbaffd3799194a6a5a8cbd7f
    /**
     * The assets version.
     *
     * @var string
     */
    private $version;
    /**
     * Whether Germanized plugin is active.
     *
     * @var bool
     */
    protected $is_gzd_active;
    /**
     * Whether WC Shipments plugin is active
     *
     * @var bool
     */
    protected $is_wc_shipment_active;
    /**
     * Whether WC Shipping & Tax plugin is active
     *
     * @var bool
     */
    private $is_wc_shipping_tax_active;
    /**
     * The bearer.
     *
     * @var Bearer
     */
    protected $bearer;
    /**
<<<<<<< HEAD
     * Compat module assets constructor.
     *
     * @param string $module_url The URL to the module.
     * @param string $version The assets version.
     * @param bool   $is_gzd_active Whether Germanized plugin is active.
     * @param bool   $is_wc_shipment_active Whether WC Shipments plugin is active.
     * @param bool   $is_wc_shipping_tax_active Whether WC Shipping & Tax plugin is active.
     * @param Bearer $bearer The bearer.
     */
    public function __construct(string $module_url, string $version, bool $is_gzd_active, bool $is_wc_shipment_active, bool $is_wc_shipping_tax_active, Bearer $bearer)
    {
        $this->module_url = $module_url;
=======
     * @param AssetGetter $asset_getter
     * @param string      $version The assets version.
     * @param bool        $is_gzd_active Whether Germanized plugin is active.
     * @param bool        $is_wc_shipment_active Whether WC Shipments plugin is active.
     * @param bool        $is_wc_shipping_tax_active Whether WC Shipping & Tax plugin is active.
     * @param Bearer      $bearer The bearer.
     */
    public function __construct(AssetGetter $asset_getter, string $version, bool $is_gzd_active, bool $is_wc_shipment_active, bool $is_wc_shipping_tax_active, Bearer $bearer)
    {
        $this->asset_getter = $asset_getter;
>>>>>>> 65cb868516d40f3fcbaffd3799194a6a5a8cbd7f
        $this->version = $version;
        $this->is_gzd_active = $is_gzd_active;
        $this->is_wc_shipment_active = $is_wc_shipment_active;
        $this->is_wc_shipping_tax_active = $is_wc_shipping_tax_active;
        $this->bearer = $bearer;
    }
    /**
     * Registers the scripts and styles.
     *
     * @return void
     */
    public function register(): void
    {
        if ($this->is_tracking_enabled($this->bearer)) {
<<<<<<< HEAD
            wp_register_script('ppcp-tracking-compat', untrailingslashit($this->module_url) . '/assets/js/tracking-compat.js', array('jquery'), $this->version, \true);
=======
            wp_register_script('ppcp-tracking-compat', $this->asset_getter->get_asset_url('tracking-compat.js'), array('jquery'), $this->version, \true);
>>>>>>> 65cb868516d40f3fcbaffd3799194a6a5a8cbd7f
            wp_localize_script('ppcp-tracking-compat', 'PayPalCommerceGatewayOrderTrackingCompat', array('gzd_sync_enabled' => apply_filters('woocommerce_paypal_payments_sync_gzd_tracking', \true) && $this->is_gzd_active, 'wc_shipment_sync_enabled' => apply_filters('woocommerce_paypal_payments_sync_wc_shipment_tracking', \true) && $this->is_wc_shipment_active, 'wc_shipping_tax_sync_enabled' => apply_filters('woocommerce_paypal_payments_sync_wc_shipping_tax', \true) && $this->is_wc_shipping_tax_active));
        }
    }
    /**
     * Enqueues the necessary scripts.
     *
     * @return void
     */
    public function enqueue(): void
    {
        if ($this->is_tracking_enabled($this->bearer)) {
            wp_enqueue_script('ppcp-tracking-compat');
        }
    }
}
