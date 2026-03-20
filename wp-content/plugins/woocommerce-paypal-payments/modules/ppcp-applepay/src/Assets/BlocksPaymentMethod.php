<?php

/**
 * The applepay blocks module.
 *
 * @package WooCommerce\PayPalCommerce\Applepay
 */
declare (strict_types=1);
namespace WooCommerce\PayPalCommerce\Applepay\Assets;

use Automattic\WooCommerce\Blocks\Payments\Integrations\AbstractPaymentMethodType;
use Automattic\WooCommerce\Blocks\Payments\PaymentMethodTypeInterface;
<<<<<<< HEAD
=======
use WooCommerce\PayPalCommerce\Assets\AssetGetter;
>>>>>>> 65cb868516d40f3fcbaffd3799194a6a5a8cbd7f
use WooCommerce\PayPalCommerce\Button\Assets\ButtonInterface;
/**
 * Class BlocksPaymentMethod
 */
class BlocksPaymentMethod extends AbstractPaymentMethodType
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
     * The button.
     *
     * @var ButtonInterface
     */
    private $button;
    /**
     * The paypal payment method.
     *
     * @var PaymentMethodTypeInterface
     */
    private $paypal_payment_method;
    /**
     * Assets constructor.
     *
     * @param string                     $name The name of this module.
<<<<<<< HEAD
     * @param string                     $module_url The url of this module.
=======
     * @param AssetGetter                $asset_getter
>>>>>>> 65cb868516d40f3fcbaffd3799194a6a5a8cbd7f
     * @param string                     $version The assets version.
     * @param ButtonInterface            $button The button.
     * @param PaymentMethodTypeInterface $paypal_payment_method The paypal payment method.
     */
<<<<<<< HEAD
    public function __construct(string $name, string $module_url, string $version, ButtonInterface $button, PaymentMethodTypeInterface $paypal_payment_method)
    {
        $this->name = $name;
        $this->module_url = $module_url;
=======
    public function __construct(string $name, AssetGetter $asset_getter, string $version, ButtonInterface $button, PaymentMethodTypeInterface $paypal_payment_method)
    {
        $this->name = $name;
        $this->asset_getter = $asset_getter;
>>>>>>> 65cb868516d40f3fcbaffd3799194a6a5a8cbd7f
        $this->version = $version;
        $this->button = $button;
        $this->paypal_payment_method = $paypal_payment_method;
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
        return $this->paypal_payment_method->is_active();
    }
    /**
     * {@inheritDoc}
     */
    public function get_payment_method_script_handles()
    {
        $handle = $this->name . '-block';
<<<<<<< HEAD
        wp_register_script($handle, trailingslashit($this->module_url) . 'assets/js/boot-block.js', array(), $this->version, \true);
=======
        wp_register_script($handle, $this->asset_getter->get_asset_url('boot-block.js'), array(), $this->version, \true);
>>>>>>> 65cb868516d40f3fcbaffd3799194a6a5a8cbd7f
        return array($handle);
    }
    /**
     * {@inheritDoc}
     */
    public function get_payment_method_data()
    {
        $paypal_data = $this->paypal_payment_method->get_payment_method_data();
        if (is_admin()) {
            $script_data = $this->button->script_data_for_admin();
        } else {
            $script_data = $this->button->script_data();
        }
        return array(
            'id' => $this->name,
            'title' => $paypal_data['title'],
            // TODO : see if we should use another.
            'description' => $paypal_data['description'],
            // TODO : see if we should use another.
            'enabled' => $paypal_data['smartButtonsEnabled'],
            // This button is enabled when PayPal buttons are.
            'scriptData' => $script_data,
        );
    }
}
