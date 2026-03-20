<?php

/**
 * Register and configure assets for uninstall module.
 *
 * @package WooCommerce\PayPalCommerce\Uninstall\Assets
 */
declare (strict_types=1);
namespace WooCommerce\PayPalCommerce\Uninstall\Assets;

<<<<<<< HEAD
=======
use WooCommerce\PayPalCommerce\Assets\AssetGetter;
>>>>>>> 65cb868516d40f3fcbaffd3799194a6a5a8cbd7f
/**
 * Class ClearDatabaseAssets
 */
class ClearDatabaseAssets
{
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
     * The script name.
     *
     * @var string
     */
    protected $script_name;
    /**
     * A map of script data.
     *
     * @var array
     */
    protected $script_data;
    /**
<<<<<<< HEAD
     * ClearDatabaseAssets constructor.
     *
     * @param string $module_url The URL to the module.
     * @param string $version The assets version.
     * @param string $script_name The script name.
     * @param array  $script_data A map of script data.
     */
    public function __construct(string $module_url, string $version, string $script_name, array $script_data)
    {
        $this->module_url = $module_url;
=======
     * @param AssetGetter $asset_getter
     * @param string      $version The assets version.
     * @param string      $script_name The script name.
     * @param array       $script_data A map of script data.
     */
    public function __construct(AssetGetter $asset_getter, string $version, string $script_name, array $script_data)
    {
        $this->asset_getter = $asset_getter;
>>>>>>> 65cb868516d40f3fcbaffd3799194a6a5a8cbd7f
        $this->version = $version;
        $this->script_data = $script_data;
        $this->script_name = $script_name;
    }
    /**
     * Registers the scripts and styles.
     *
     * @return void
     */
    public function register(): void
    {
<<<<<<< HEAD
        $module_url = untrailingslashit($this->module_url);
        wp_register_script($this->script_name, "{$module_url}/assets/js/{$this->script_name}.js", array('jquery'), $this->version, \true);
=======
        wp_register_script($this->script_name, $this->asset_getter->get_asset_url("{$this->script_name}.js"), array('jquery'), $this->version, \true);
>>>>>>> 65cb868516d40f3fcbaffd3799194a6a5a8cbd7f
        wp_localize_script($this->script_name, 'PayPalCommerceGatewayClearDb', $this->script_data);
    }
    /**
     * Enqueues the necessary scripts.
     *
     * @return void
     */
    public function enqueue(): void
    {
        wp_enqueue_script($this->script_name);
    }
}
