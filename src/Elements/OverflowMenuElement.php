<?php

namespace Arouze\SlackMessageBuilder\Elements;

use Arouze\SlackMessageBuilder\Blocks\ActionBlock;
use Arouze\SlackMessageBuilder\Blocks\SectionBlock;
use Arouze\SlackMessageBuilder\Common\ActionIdInterface;
use Arouze\SlackMessageBuilder\Common\ActionIdTrait;

class OverflowMenuElement implements BlockElementsInterface, ActionIdInterface, ConfirmableElementInterface
{
    use ActionIdTrait;
    use ConfirmElementTrait;
    use OptionObjectTrait;

    // @doc : https://api.slack.com/reference/block-kit/block-elements#overflow
    private const OVERFLOW_MENU_TYPE = 'overflow';

    private const MAX_OPTIONS = 5;
    private array $block = [
        'type' => self::OVERFLOW_MENU_TYPE
    ];
    private function validate(): void
    {
        $this->validateMaxOptions(self::MAX_OPTIONS);
    }

    public function toArray(): array
    {
        $this->validate();

        $this
            ->handleOptions()
            ->handleConfirm()
            ->handleActionId();

        return $this->block;
    }

    public function getCompatibleBlocks(): array
    {
        return [
            SectionBlock::class,
            ActionBlock::class
        ];
    }
}
