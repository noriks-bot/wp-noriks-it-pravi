<?php

/**
 * Handles migration of settings tab settings from legacy format to new structure.
 *
 * @package WooCommerce\PayPalCommerce\Settings\Service\Migration
 */
declare (strict_types=1);
namespace WooCommerce\PayPalCommerce\Settings\Service\Migration;

use WooCommerce\PayPalCommerce\ApiClient\Entity\ExperienceContext;
use WooCommerce\PayPalCommerce\ApiClient\Helper\PurchaseUnitSanitizer;
use WooCommerce\PayPalCommerce\Compat\Settings\SettingsTabMapHelper;
use WooCommerce\PayPalCommerce\Settings\Data\SettingsModel;
<<<<<<< HEAD
use WooCommerce\PayPalCommerce\WcGateway\Settings\Settings;
=======
>>>>>>> 65cb868516d40f3fcbaffd3799194a6a5a8cbd7f
/**
 * Class SettingsTabMigration
 *
 * Handles migration of settings tab settings.
 */
class SettingsTabMigration implements \WooCommerce\PayPalCommerce\Settings\Service\Migration\SettingsMigrationInterface
{
<<<<<<< HEAD
    protected Settings $settings;
    protected SettingsModel $settings_tab;
    protected SettingsTabMapHelper $settings_tab_map_helper;
    public function __construct(Settings $settings, SettingsModel $settings_tab, SettingsTabMapHelper $settings_tab_map_helper)
=======
    /**
     * @var array<string, mixed>
     */
    protected array $settings;
    protected SettingsModel $settings_tab;
    protected SettingsTabMapHelper $settings_tab_map_helper;
    public function __construct(array $settings, SettingsModel $settings_tab, SettingsTabMapHelper $settings_tab_map_helper)
>>>>>>> 65cb868516d40f3fcbaffd3799194a6a5a8cbd7f
    {
        $this->settings = $settings;
        $this->settings_tab = $settings_tab;
        $this->settings_tab_map_helper = $settings_tab_map_helper;
    }
    public function migrate(): void
    {
        $data = array();
        foreach ($this->settings_tab_map_helper->map() as $old_key => $new_key) {
<<<<<<< HEAD
            if (!$this->settings->has($old_key)) {
=======
            if (!isset($this->settings[$old_key])) {
>>>>>>> 65cb868516d40f3fcbaffd3799194a6a5a8cbd7f
                continue;
            }
            switch ($old_key) {
                case 'subtotal_mismatch_behavior':
<<<<<<< HEAD
                    $value = $this->settings->get($old_key);
                    $data[$new_key] = $value === PurchaseUnitSanitizer::MODE_EXTRA_LINE ? 'correction' : 'no_details';
                    break;
                case 'landing_page':
                    $value = $this->settings->get($old_key);
                    $data[$new_key] = $value === ExperienceContext::LANDING_PAGE_LOGIN ? 'login' : ($value === ExperienceContext::LANDING_PAGE_GUEST_CHECKOUT ? 'guest_checkout' : 'any');
                    break;
                case 'intent':
                    $value = $this->settings->get($old_key);
=======
                    $value = $this->settings[$old_key];
                    $data[$new_key] = $value === PurchaseUnitSanitizer::MODE_EXTRA_LINE ? 'correction' : 'no_details';
                    break;
                case 'landing_page':
                    $value = $this->settings[$old_key];
                    $data[$new_key] = $value === ExperienceContext::LANDING_PAGE_LOGIN ? 'login' : ($value === ExperienceContext::LANDING_PAGE_GUEST_CHECKOUT ? 'guest_checkout' : 'any');
                    break;
                case 'intent':
                    $value = $this->settings[$old_key];
>>>>>>> 65cb868516d40f3fcbaffd3799194a6a5a8cbd7f
                    $data['authorize_only'] = $value === 'authorize';
                    $data['capture_virtual_orders'] = $value === 'capture';
                    break;
                case 'blocks_final_review_enabled':
<<<<<<< HEAD
                    $data[$new_key] = !$this->settings->get($old_key);
                    break;
                case '3d_secure_contingency':
                    $value = $this->settings->get($old_key);
=======
                    $data[$new_key] = !$this->settings[$old_key];
                    break;
                case '3d_secure_contingency':
                    $value = $this->settings[$old_key];
>>>>>>> 65cb868516d40f3fcbaffd3799194a6a5a8cbd7f
                    $old_to_new_3d_secure_map = array_flip(SettingsTabMapHelper::THREE_D_SECURE_VALUES_MAP);
                    $data[$new_key] = $old_to_new_3d_secure_map[$value] ?? 'NO_3D_SECURE';
                    break;
                default:
<<<<<<< HEAD
                    $data[$new_key] = $this->settings->get($old_key);
=======
                    $data[$new_key] = $this->settings[$old_key];
>>>>>>> 65cb868516d40f3fcbaffd3799194a6a5a8cbd7f
            }
        }
        $this->settings_tab->from_array($data);
        $this->settings_tab->save();
    }
}
