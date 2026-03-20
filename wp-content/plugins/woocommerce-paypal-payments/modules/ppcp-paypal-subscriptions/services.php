<?php

/**
 * The PayPalSubscriptions module services.
 *
 * @package WooCommerce\PayPalCommerce\PayPalSubscriptions
 */
declare (strict_types=1);
namespace WooCommerce\PayPalCommerce\PayPalSubscriptions;

<<<<<<< HEAD
=======
use WooCommerce\PayPalCommerce\Assets\AssetGetter;
use WooCommerce\PayPalCommerce\Assets\AssetGetterFactory;
>>>>>>> 65cb868516d40f3fcbaffd3799194a6a5a8cbd7f
use WooCommerce\PayPalCommerce\Vendor\Psr\Container\ContainerInterface;
return array('paypal-subscriptions.deactivate-plan-endpoint' => static function (ContainerInterface $container): \WooCommerce\PayPalCommerce\PayPalSubscriptions\DeactivatePlanEndpoint {
    return new \WooCommerce\PayPalCommerce\PayPalSubscriptions\DeactivatePlanEndpoint($container->get('button.request-data'), $container->get('api.endpoint.billing-plans'));
}, 'paypal-subscriptions.api-handler' => static function (ContainerInterface $container): \WooCommerce\PayPalCommerce\PayPalSubscriptions\SubscriptionsApiHandler {
    return new \WooCommerce\PayPalCommerce\PayPalSubscriptions\SubscriptionsApiHandler($container->get('api.endpoint.catalog-products'), $container->get('api.factory.product'), $container->get('api.endpoint.billing-plans'), $container->get('api.factory.billing-cycle'), $container->get('api.factory.payment-preferences'), $container->get('api.shop.currency.getter'), $container->get('woocommerce.logger.woocommerce'));
<<<<<<< HEAD
}, 'paypal-subscriptions.module.url' => static function (ContainerInterface $container): string {
    return plugins_url('/modules/ppcp-paypal-subscriptions/', $container->get('ppcp.path-to-plugin-main-file'));
=======
}, 'paypal-subscriptions.asset_getter' => static function (ContainerInterface $container): AssetGetter {
    $factory = $container->get('assets.asset_getter_factory');
    assert($factory instanceof AssetGetterFactory);
    return $factory->for_module('ppcp-paypal-subscriptions');
>>>>>>> 65cb868516d40f3fcbaffd3799194a6a5a8cbd7f
}, 'paypal-subscriptions.renewal-handler' => static function (ContainerInterface $container): \WooCommerce\PayPalCommerce\PayPalSubscriptions\RenewalHandler {
    return new \WooCommerce\PayPalCommerce\PayPalSubscriptions\RenewalHandler($container->get('woocommerce.logger.woocommerce'));
}, 'paypal-subscriptions.status' => static function (ContainerInterface $container): \WooCommerce\PayPalCommerce\PayPalSubscriptions\SubscriptionStatus {
    return new \WooCommerce\PayPalCommerce\PayPalSubscriptions\SubscriptionStatus($container->get('api.endpoint.billing-subscriptions'), $container->get('woocommerce.logger.woocommerce'));
});
