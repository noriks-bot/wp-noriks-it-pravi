<?php

/**
 * The Pay Later block module services.
 *
 * @package WooCommerce\PayPalCommerce\PayLaterBlock
 */
declare (strict_types=1);
namespace WooCommerce\PayPalCommerce\PayLaterBlock;

<<<<<<< HEAD
use WooCommerce\PayPalCommerce\PayLaterBlock\PayLaterBlockRenderer;
use WooCommerce\PayPalCommerce\Vendor\Psr\Container\ContainerInterface;
return array('paylater-block.url' => static function (ContainerInterface $container): string {
    return plugins_url('/modules/ppcp-paylater-block/', $container->get('ppcp.path-to-plugin-main-file'));
=======
use WooCommerce\PayPalCommerce\Assets\AssetGetter;
use WooCommerce\PayPalCommerce\Assets\AssetGetterFactory;
use WooCommerce\PayPalCommerce\PayLaterBlock\PayLaterBlockRenderer;
use WooCommerce\PayPalCommerce\Vendor\Psr\Container\ContainerInterface;
return array('paylater-block.asset_getter' => static function (ContainerInterface $container): AssetGetter {
    $factory = $container->get('assets.asset_getter_factory');
    assert($factory instanceof AssetGetterFactory);
    return $factory->for_module('ppcp-paylater-block');
>>>>>>> 65cb868516d40f3fcbaffd3799194a6a5a8cbd7f
}, 'paylater-block.renderer' => static function (): PayLaterBlockRenderer {
    return new PayLaterBlockRenderer();
});
