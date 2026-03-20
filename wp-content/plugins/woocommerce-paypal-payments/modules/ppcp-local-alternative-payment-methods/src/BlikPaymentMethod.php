<?php

/**
 * Blik payment method.
 *
 * @package WooCommerce\PayPalCommerce\LocalAlternativePaymentMethods
 */
declare (strict_types=1);
namespace WooCommerce\PayPalCommerce\LocalAlternativePaymentMethods;

use Automattic\WooCommerce\Blocks\Payments\Integrations\AbstractPaymentMethodType;
<<<<<<< HEAD
=======
use WooCommerce\PayPalCommerce\Assets\AssetGetter;
>>>>>>> 65cb868516d40f3fcbaffd3799194a6a5a8cbd7f
/**
 * Class BlikPaymentMethod
 */
class BlikPaymentMethod extends AbstractPaymentMethodType
{
<<<<<<< HEAD
    /**
     * The URL of this module.
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
     * Blik WC gateway.
     *
     * @var BlikGateway
     */
    private $gateway;
    /**
<<<<<<< HEAD
     * BlikPaymentMethod constructor.
     *
     * @param string      $module_url The URL of this module.
     * @param string      $version The assets version.
     * @param BlikGateway $gateway Blik WC gateway.
     */
    public function __construct(string $module_url, string $version, \WooCommerce\PayPalCommerce\LocalAlternativePaymentMethods\BlikGateway $gateway)
    {
        $this->module_url = $module_url;
=======
     * @param AssetGetter $asset_getter
     * @param string      $version The assets version.
     * @param BlikGateway $gateway Blik WC gateway.
     */
    public function __construct(AssetGetter $asset_getter, string $version, \WooCommerce\PayPalCommerce\LocalAlternativePaymentMethods\BlikGateway $gateway)
    {
        $this->asset_getter = $asset_getter;
>>>>>>> 65cb868516d40f3fcbaffd3799194a6a5a8cbd7f
        $this->version = $version;
        $this->gateway = $gateway;
        $this->name = \WooCommerce\PayPalCommerce\LocalAlternativePaymentMethods\BlikGateway::ID;
    }
    /**
     * {@inheritDoc}
     */
    public function initialize()
    {
    }
    /**
     * {@inheritDoc}
     */
    public function is_active()
    {
        return \true;
    }
    /**
     * {@inheritDoc}
     */
    public function get_payment_method_script_handles()
    {
<<<<<<< HEAD
        wp_register_script('ppcp-blick-payment-method', trailingslashit($this->module_url) . 'assets/js/blik-payment-method.js', array(), $this->version, \true);
=======
        wp_register_script('ppcp-blick-payment-method', $this->asset_getter->get_asset_url('blik-payment-method.js'), array(), $this->version, \true);
>>>>>>> 65cb868516d40f3fcbaffd3799194a6a5a8cbd7f
        return array('ppcp-blick-payment-method');
    }
    /**
     * {@inheritDoc}
     */
    public function get_payment_method_data()
    {
        return array('id' => $this->name, 'title' => $this->gateway->title, 'description' => $this->gateway->description, 'icon' => $this->gateway->icon);
    }
}
