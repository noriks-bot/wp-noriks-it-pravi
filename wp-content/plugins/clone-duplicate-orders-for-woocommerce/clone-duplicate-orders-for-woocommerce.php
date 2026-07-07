<?php
/**
 * Clone / Duplicate Orders for WooCommerce
 *
 * @package           clone-duplicate-orders-for-woocommerce
 * @author            YMMV LLC
 * @copyright         2026 YMMV LLC
 * @license           GPL-2.0-or-later
 *
 * @wordpress-plugin
 * Plugin Name:             Clone / Duplicate Orders for WooCommerce
 * Description:             Clone, duplicate or copy WooCommerce orders in one-click. HPOS compatible.
 * Author:                  YMMV LLC
 * Contributors:            ymmvplugins
 * Author URI:              https://www.ymmv.co
 * Text Domain:             clone-duplicate-orders-for-woocommerce
 * Domain Path:             /languages
 * Version:                 1.0.11
 * Requires PHP:            7.4
 * Requires at least:       6.0
 * Tested up to:            6.9
 * WC requires at least:    8.2.0
 * WC tested up to:         10.4.3
 * Requires Plugins:        woocommerce
 * License:                 GPL-2.0-or-later
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Get version number from this plugin version.
 */
function cdo_wc_get_version() {
	if ( ! function_exists( 'get_plugins' ) ) {
		require_once ABSPATH . 'wp-admin/includes/plugin.php';
	}
	$plugin_folder = get_plugins( '/' . plugin_basename( __DIR__ ) );
	$plugin_file   = basename( ( __FILE__ ) );
	return $plugin_folder[ $plugin_file ]['Version'];
}

define( 'CDO_WC_PLUGIN_FILE', __FILE__ );
define( 'CDO_WC_PLUGIN_PATH', plugin_dir_path( __FILE__ ) );
define( 'CDO_WC_PLUGIN_URL', plugin_dir_url( CDO_WC_PLUGIN_FILE ) );
define( 'CDO_WC_ASSETS_URL', CDO_WC_PLUGIN_URL . 'assets/' );
define( 'CDO_WC_INCLUDES_PATH', CDO_WC_PLUGIN_PATH . 'includes/' );
define( 'CDO_WC_PLUGIN_BASENAME', plugin_basename( __FILE__ ) );
define( 'CDO_WC_VERSION_NUM', cdo_wc_get_version() );

require_once CDO_WC_INCLUDES_PATH . '/class-cdo-wc-init.php';

register_activation_hook( __FILE__, array( 'CDO_WC\CDO_WC_Init', 'activate' ) );

new \CDO_WC\CDO_WC_Init();
