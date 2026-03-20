<?php

/**
 * The services of the admin notice module.
 *
 * @package WooCommerce\PayPalCommerce\Button
 */
declare (strict_types=1);
namespace WooCommerce\PayPalCommerce\AdminNotices;

<<<<<<< HEAD
=======
use WooCommerce\PayPalCommerce\Assets\AssetGetter;
use WooCommerce\PayPalCommerce\Assets\AssetGetterFactory;
>>>>>>> 65cb868516d40f3fcbaffd3799194a6a5a8cbd7f
use WooCommerce\PayPalCommerce\Vendor\Psr\Container\ContainerInterface;
use WooCommerce\PayPalCommerce\AdminNotices\Renderer\Renderer;
use WooCommerce\PayPalCommerce\AdminNotices\Renderer\RendererInterface;
use WooCommerce\PayPalCommerce\AdminNotices\Repository\Repository;
use WooCommerce\PayPalCommerce\AdminNotices\Repository\RepositoryInterface;
use WooCommerce\PayPalCommerce\AdminNotices\Endpoint\MuteMessageEndpoint;
<<<<<<< HEAD
return array('admin-notices.url' => static function (ContainerInterface $container): string {
    return plugins_url('/modules/ppcp-admin-notices/', $container->get('ppcp.path-to-plugin-main-file'));
}, 'admin-notices.renderer' => static function (ContainerInterface $container): RendererInterface {
    return new Renderer($container->get('admin-notices.repository'), $container->get('admin-notices.url'), $container->get('ppcp.asset-version'));
=======
return array('admin-notices.asset_getter' => static function (ContainerInterface $container): AssetGetter {
    $factory = $container->get('assets.asset_getter_factory');
    assert($factory instanceof AssetGetterFactory);
    return $factory->for_module('ppcp-admin-notices');
}, 'admin-notices.renderer' => static function (ContainerInterface $container): RendererInterface {
    return new Renderer($container->get('admin-notices.repository'), $container->get('admin-notices.asset_getter'), $container->get('ppcp.asset-version'));
>>>>>>> 65cb868516d40f3fcbaffd3799194a6a5a8cbd7f
}, 'admin-notices.repository' => static function (ContainerInterface $container): RepositoryInterface {
    return new Repository();
}, 'admin-notices.mute-message-endpoint' => static function (ContainerInterface $container): MuteMessageEndpoint {
    return new MuteMessageEndpoint($container->get('button.request-data'), $container->get('admin-notices.repository'));
});
