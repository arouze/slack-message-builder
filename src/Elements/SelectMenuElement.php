<?php

namespace Arouze\SlackMessageBuilder\Elements;

use Arouze\SlackMessageBuilder\Blocks\ActionBlock;
use Arouze\SlackMessageBuilder\Blocks\InputBlock;
use Arouze\SlackMessageBuilder\Blocks\SectionBlock;
use Arouze\SlackMessageBuilder\Common\ActionIdInterface;
use Arouze\SlackMessageBuilder\Common\ActionIdTrait;
use Arouze\SlackMessageBuilder\Exceptions\IncorrectOptionsConfigurationException;

class SelectMenuElement implements BlockElementsInterface, ActionIdInterface, ConfirmableElementInterface, FocusableInterface // phpcs:ignore
{
    use ActionIdTrait;
    use OptionObjectTrait;
    use OptionGroupObjectTrait;
    use InitialOptionsTrait;
    use ConfirmElementTrait;
    use FocusOnLoadTrait;
    use PlaceHolderTrait;

    // @doc : https://api.slack.com/reference/block-kit/block-elements#select

    private const SELECT_MENU_TYPE = 'static_select';

    private const MAX_OPTIONS = 100;

    private const MAX_OPTIONS_GROUP = 100;

    private const PLACEHOLDER_MAX_LENGTH = 150;

    private array $block = [
        'type' => self::SELECT_MENU_TYPE
    ];

    private function validate(): void
    {
        $this->validateMaxOptions(self::MAX_OPTIONS);

        $this->validateOptionGroup(self::MAX_OPTIONS_GROUP);

        $this->validatePlaceHolder(self::PLACEHOLDER_MAX_LENGTH);

        if (count($this->options) && count($this->optionGroups)) {
            throw new IncorrectOptionsConfigurationException(self::class);
        }
    }

    public function toArray(): array
    {
        $this->validate();

        $this
            ->handleActionId()
            ->handleOptionGroup()
            ->handleOptions()
            ->handleInitialOptions()
            ->handleConfirm()
            ->handleFocusOnLoad()
            ->handlePlaceHolder()
        ;

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
