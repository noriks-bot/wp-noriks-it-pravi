<?php

/**
 * @package WooCommerce\PayPalCommerce\WcGateway\Settings
 */
declare (strict_types=1);
namespace WooCommerce\PayPalCommerce\WcGateway\Settings\WcInboxNotes;

/**
 * A factory for creating inbox notes.
 */
class InboxNoteFactory
{
<<<<<<< HEAD
    public function create_note(string $title, string $content, string $type, string $name, string $status, bool $is_enabled, \WooCommerce\PayPalCommerce\WcGateway\Settings\WcInboxNotes\InboxNoteActionInterface $action): \WooCommerce\PayPalCommerce\WcGateway\Settings\WcInboxNotes\InboxNoteInterface
    {
        return new \WooCommerce\PayPalCommerce\WcGateway\Settings\WcInboxNotes\InboxNote($title, $content, $type, $name, $status, $is_enabled, $action);
=======
    public function create_note(string $title, string $content, string $type, string $name, string $status, bool $is_enabled, \WooCommerce\PayPalCommerce\WcGateway\Settings\WcInboxNotes\InboxNoteActionInterface ...$actions): \WooCommerce\PayPalCommerce\WcGateway\Settings\WcInboxNotes\InboxNoteInterface
    {
        return new \WooCommerce\PayPalCommerce\WcGateway\Settings\WcInboxNotes\InboxNote($title, $content, $type, $name, $status, $is_enabled, ...$actions);
>>>>>>> 65cb868516d40f3fcbaffd3799194a6a5a8cbd7f
    }
}
