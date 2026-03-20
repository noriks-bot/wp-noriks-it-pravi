<?php

/**
 * @package WooCommerce\PayPalCommerce\WcGateway\Settings
 */
declare (strict_types=1);
namespace WooCommerce\PayPalCommerce\WcGateway\Settings\WcInboxNotes;

/**
 * A note that can be displayed in the WooCommerce inbox section.
 */
class InboxNote implements \WooCommerce\PayPalCommerce\WcGateway\Settings\WcInboxNotes\InboxNoteInterface
{
    protected string $title;
    protected string $content;
    protected string $type;
    protected string $name;
    protected string $status;
    protected bool $is_enabled;
<<<<<<< HEAD
    protected \WooCommerce\PayPalCommerce\WcGateway\Settings\WcInboxNotes\InboxNoteActionInterface $action;
    public function __construct(string $title, string $content, string $type, string $name, string $status, bool $is_enabled, \WooCommerce\PayPalCommerce\WcGateway\Settings\WcInboxNotes\InboxNoteActionInterface $action)
=======
    /**
     * @var InboxNoteActionInterface[]
     */
    protected array $actions;
    public function __construct(string $title, string $content, string $type, string $name, string $status, bool $is_enabled, \WooCommerce\PayPalCommerce\WcGateway\Settings\WcInboxNotes\InboxNoteActionInterface ...$actions)
>>>>>>> 65cb868516d40f3fcbaffd3799194a6a5a8cbd7f
    {
        $this->title = $title;
        $this->content = $content;
        $this->type = $type;
        $this->name = $name;
        $this->status = $status;
        $this->is_enabled = $is_enabled;
<<<<<<< HEAD
        $this->action = $action;
=======
        $this->actions = $actions;
>>>>>>> 65cb868516d40f3fcbaffd3799194a6a5a8cbd7f
    }
    public function title(): string
    {
        return $this->title;
    }
    public function content(): string
    {
        return $this->content;
    }
    public function type(): string
    {
        return $this->type;
    }
    public function name(): string
    {
        return $this->name;
    }
    public function status(): string
    {
        return $this->status;
    }
    public function is_enabled(): bool
    {
        return $this->is_enabled;
    }
<<<<<<< HEAD
    public function action(): \WooCommerce\PayPalCommerce\WcGateway\Settings\WcInboxNotes\InboxNoteActionInterface
    {
        return $this->action;
=======
    /**
     * @return InboxNoteActionInterface[]
     */
    public function actions(): array
    {
        return $this->actions;
>>>>>>> 65cb868516d40f3fcbaffd3799194a6a5a8cbd7f
    }
}
