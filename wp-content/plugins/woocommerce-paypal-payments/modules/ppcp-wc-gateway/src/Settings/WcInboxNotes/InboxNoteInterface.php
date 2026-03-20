<?php

/**
 * Represents a note that can be displayed in the WooCommerce inbox section.
 *
 * @package WooCommerce\PayPalCommerce\WcGateway\Settings
 */
declare (strict_types=1);
namespace WooCommerce\PayPalCommerce\WcGateway\Settings\WcInboxNotes;

interface InboxNoteInterface
{
    public function title(): string;
    public function content(): string;
    public function type(): string;
    public function name(): string;
    public function status(): string;
    public function is_enabled(): bool;
<<<<<<< HEAD
    public function action(): \WooCommerce\PayPalCommerce\WcGateway\Settings\WcInboxNotes\InboxNoteActionInterface;
=======
    /**
     * @return InboxNoteActionInterface[]
     */
    public function actions(): array;
>>>>>>> 65cb868516d40f3fcbaffd3799194a6a5a8cbd7f
}
