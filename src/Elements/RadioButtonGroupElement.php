<?php

namespace Arouze\SlackMessageBuilder\Elements;

use Arouze\SlackMessageBuilder\Blocks\ActionBlock;
use Arouze\SlackMessageBuilder\Blocks\InputBlock;
use Arouze\SlackMessageBuilder\Blocks\SectionBlock;
use Arouze\SlackMessageBuilder\Common\ActionIdInterface;
use Arouze\SlackMessageBuilder\Common\ActionIdTrait;

class RadioButtonGroupElement implements BlockElementsInterface, ActionIdInterface, ConfirmableElementInterface, FocusableInterface // phpcs:ignore
{
    use ActionIdTrait;
    use OptionObjectTrait;
    use InitialOptionsTrait;
    use ConfirmElementTrait;
    use FocusOnLoadTrait;

    // @doc : https://api.slack.com/reference/block-kit/block-elements#radio
    private const RADIO_BUTTON_GROUP_TYPE = 'radio_buttons';

    private const MAX_OPTIONS = 10;

    private array $block = [
        'type' => self::RADIO_BUTTON_GROUP_TYPE
    ];

    private function validate(): void
    {
        $this->validateMaxOptions(self::MAX_OPTIONS);
    }

    public function toArray(): array
    {
        $this->validate();

        $this
            ->handleActionId()
            ->handleOptions()
            ->handleInitialOptions()
            ->handleConfirm()
            ->handleFocusOnLoad();

        return $this->block;
    }

    public function getCompatibleBlocks(): array
    {
        return [
            SectionBlock::class,
            ActionBlock::class,
            InputBlock::class
        ];
    }
}
