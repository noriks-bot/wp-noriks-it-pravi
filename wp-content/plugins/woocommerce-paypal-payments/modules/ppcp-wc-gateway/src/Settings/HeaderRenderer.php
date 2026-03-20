<?php

/**
 * Renders the settings page header.
 *
 * @package WooCommerce\PayPalCommerce\WcGateway\Settings
 */
declare (strict_types=1);
namespace WooCommerce\PayPalCommerce\WcGateway\Settings;

<<<<<<< HEAD
=======
use WooCommerce\PayPalCommerce\Assets\AssetGetter;
>>>>>>> 65cb868516d40f3fcbaffd3799194a6a5a8cbd7f
/**
 * Class HeaderRenderer
 */
class HeaderRenderer
{
    const KEY = 'ppcp-tab';
    /**
     * ID of the current PPCP gateway settings page, or empty if it is not such page.
     *
     * @var string
     */
    private $page_id;
<<<<<<< HEAD
    /**
     * The URL to the module.
     *
     * @var string
     */
    private $module_url;
    /**
     * HeaderRenderer constructor.
     *
     * @param string $page_id ID of the current PPCP gateway settings page, or empty if it is not such page.
     * @param string $module_url The URL to the module.
     */
    public function __construct(string $page_id, string $module_url)
    {
        $this->page_id = $page_id;
        $this->module_url = $module_url;
=======
    private AssetGetter $asset_getter;
    /**
     * @param string      $page_id ID of the current PPCP gateway settings page, or empty if it is not such page.
     * @param AssetGetter $asset_getter
     */
    public function __construct(string $page_id, AssetGetter $asset_getter)
    {
        $this->page_id = $page_id;
        $this->asset_getter = $asset_getter;
>>>>>>> 65cb868516d40f3fcbaffd3799194a6a5a8cbd7f
    }
    /**
     * Whether the sections tab should be rendered.
     *
     * @return bool
     */
    public function should_render(): bool
    {
        return !empty($this->page_id);
    }
    /**
     * Renders the Sections tab.
     */
    public function render(): string
    {
        if (!$this->should_render()) {
            return '';
        }
        return '
			<div class="ppcp-settings-page-header">
<<<<<<< HEAD
				<img alt="PayPal" src="' . esc_url($this->module_url) . 'assets/images/paypal.png" style="max-height: 30px" />
=======
				<img alt="PayPal" src="' . $this->asset_getter->get_static_asset_url('images/paypal.png') . '" style="max-height: 30px" />
>>>>>>> 65cb868516d40f3fcbaffd3799194a6a5a8cbd7f
				<h4> <span class="ppcp-inline-only">-</span> ' . __('The all-in-one checkout solution for WooCommerce', 'woocommerce-paypal-payments') . '</h4>
				<a class="button" target="_blank" href="https://woocommerce.com/document/woocommerce-paypal-payments/">' . __('Documentation', 'woocommerce-paypal-payments') . '</a>
				<a class="button" target="_blank" href="https://woocommerce.com/document/woocommerce-paypal-payments/#get-help">' . __('Get Help', 'woocommerce-paypal-payments') . '</a>
				<span class="ppcp-right-align">
					<a target="_blank" href="https://woocommerce.com/feature-requests/woocommerce-paypal-payments/">' . __('Request a feature', 'woocommerce-paypal-payments') . '</a>
					<a target="_blank" href="https://github.com/woocommerce/woocommerce-paypal-payments/issues/new?assignees=&labels=type%3A+bug&template=bug_report.md">' . __('Submit a bug', 'woocommerce-paypal-payments') . '</a>
				</span>
				' . apply_filters('woocommerce_paypal_payments_inside_settings_page_header', '') . '
			</div>

			<div class="ppcp-notice-wrapper"></div>
		';
    }
}
