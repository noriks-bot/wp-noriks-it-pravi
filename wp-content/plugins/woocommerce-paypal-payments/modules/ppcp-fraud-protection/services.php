<?php

declare (strict_types=1);
namespace WooCommerce\PayPalCommerce\FraudProtection;

<<<<<<< HEAD
=======
use WooCommerce\PayPalCommerce\Assets\AssetGetter;
use WooCommerce\PayPalCommerce\Assets\AssetGetterFactory;
>>>>>>> 65cb868516d40f3fcbaffd3799194a6a5a8cbd7f
use WooCommerce\PayPalCommerce\FraudProtection\Recaptcha\Recaptcha;
use WooCommerce\PayPalCommerce\FraudProtection\Recaptcha\RecaptchaIntegration;
use WooCommerce\PayPalCommerce\Vendor\Psr\Container\ContainerInterface;
use WooCommerce\PayPalCommerce\WcGateway\Gateway\CardButtonGateway;
use WooCommerce\PayPalCommerce\WcGateway\Gateway\CreditCardGateway;
use WooCommerce\PayPalCommerce\WcGateway\Gateway\PayPalGateway;
<<<<<<< HEAD
return array('fraud-protection.url' => static function (ContainerInterface $container): string {
    return plugins_url('/modules/ppcp-fraud-protection/', $container->get('ppcp.path-to-plugin-main-file'));
}, 'fraud-protection.recaptcha' => static function (ContainerInterface $container): Recaptcha {
    return new Recaptcha($container->get('fraud-protection.recaptcha.integration'), $container->get('fraud-protection.recaptcha.payment-methods'), $container->get('fraud-protection.url'), $container->get('ppcp.asset-version'), $container->get('woocommerce.logger.woocommerce'));
=======
return array('fraud-protection.asset_getter' => static function (ContainerInterface $container): AssetGetter {
    $factory = $container->get('assets.asset_getter_factory');
    assert($factory instanceof AssetGetterFactory);
    return $factory->for_module('ppcp-fraud-protection');
}, 'fraud-protection.recaptcha' => static function (ContainerInterface $container): Recaptcha {
    return new Recaptcha($container->get('fraud-protection.recaptcha.integration'), $container->get('fraud-protection.recaptcha.payment-methods'), $container->get('fraud-protection.asset_getter'), $container->get('ppcp.asset-version'), $container->get('woocommerce.logger.woocommerce'), $container->get('fraud-protection.recaptcha.rejection-counter'));
>>>>>>> 65cb868516d40f3fcbaffd3799194a6a5a8cbd7f
}, 'fraud-protection.recaptcha.integration' => static function (): RecaptchaIntegration {
    return new RecaptchaIntegration();
}, 'fraud-protection.recaptcha.payment-methods' => static function (): array {
    return apply_filters('woocommerce_paypal_payments_recaptcha_payment_methods', array(PayPalGateway::ID, CreditCardGateway::ID, CardButtonGateway::ID));
<<<<<<< HEAD
=======
}, 'fraud-protection.recaptcha.rejection-counter' => static function (ContainerInterface $container): \WooCommerce\PayPalCommerce\FraudProtection\PersistentCounter {
    return new \WooCommerce\PayPalCommerce\FraudProtection\PersistentCounter(Recaptcha::REJECTION_COUNTER_OPTION);
>>>>>>> 65cb868516d40f3fcbaffd3799194a6a5a8cbd7f
}, 'fraud-protection.wc-tasks.recaptcha-task-config' => static function (ContainerInterface $container): array {
    $recaptcha_settings = get_option('woocommerce_ppcp-recaptcha_settings', array());
    if (isset($recaptcha_settings['enabled']) && 'yes' === $recaptcha_settings['enabled']) {
        return array();
    }
<<<<<<< HEAD
    return array(array('id' => 'ppcp-recaptcha-protection-task', 'title' => __('Activate PayPal fraud management', 'woocommerce-paypal-payments'), 'description' => __('PayPal detected increased suspicious card activity in market. Please enable fraud protection in your PayPal Payment settings by enabling CAPTCHA for PayPal Payments.', 'woocommerce-paypal-payments'), 'redirect_url' => admin_url('admin.php?page=wc-settings&tab=integration&section=ppcp-recaptcha')));
=======
    return array(array('id' => 'ppcp-recaptcha-protection-task', 'title' => __('Enable required fraud protection for PayPal Payments', 'woocommerce-paypal-payments'), 'description' => __('Help protect your store and maintain compliance.', 'woocommerce-paypal-payments'), 'redirect_url' => admin_url('admin.php?page=wc-settings&tab=integration&section=ppcp-recaptcha')));
>>>>>>> 65cb868516d40f3fcbaffd3799194a6a5a8cbd7f
});
