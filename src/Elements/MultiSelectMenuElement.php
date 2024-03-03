<?php

namespace Arouze\SlackMessageBuilder\Elements;

use Arouze\SlackMessageBuilder\Blocks\ActionBlock;
use Arouze\SlackMessageBuilder\Blocks\InputBlock;
use Arouze\SlackMessageBuilder\Blocks\SectionBlock;
use Arouze\SlackMessageBuilder\Common\ActionIdInterface;
use Arouze\SlackMessageBuilder\Common\ActionIdTrait;
use Arouze\SlackMessageBuilder\Exceptions\IncorrectOptionsConfigurationException;
use Arouze\SlackMessageBuilder\Exceptions\TooMuchOptionGroupsException;
use Arouze\SlackMessageBuilder\Objects\OptionGroupObject;

class MultiSelectMenuElement implements BlockElementsInterface, ActionIdInterface, ConfirmableElementInterface, FocusableInterface // phpcs:ignore
{
    use ActionIdTrait;
    use ConfirmElementTrait;
    use FocusOnLoadTrait;
    use InitialOptionsTrait;
    use OptionObjectTrait;
    use PlaceHolderTrait;

    // @doc : https://api.slack.com/reference/block-kit/block-elements#multi_select
    private const MULTI_SELECT_MENU_TYPE = 'multi_static_select';

    private const MAX_OPTIONS = 100;

    private const MAX_OPTIONS_GROUP = 100;

    private array $block = [
        'type' => self::MULTI_SELECT_MENU_TYPE
    ];

    private ?int $maxSelectedItems = null;

    private array $optionGroups = [];

    public function addOptionGroup(OptionGroupObject $optionGroupObject): self
    {
        $this->optionGroups[] = $optionGroupObject;

        return $this;
    }

    public function setMaxSelectedItems(?int $maxSelectedItems): self
    {
        $this->maxSelectedItems = $maxSelectedItems;

        return $this;
    }

    private function handleMaxSelectedItems(): self
    {
        if (!is_null($this->maxSelectedItems)) {
            $this->block['max_selected_items'] = $this->maxSelectedItems;
        }

        return $this;
    }
    private function validate(): void
    {
        $this->validateMaxOptions(self::MAX_OPTIONS);

        if (count($this->optionGroups) > self::MAX_OPTIONS_GROUP) {
            throw new TooMuchOptionGroupsException(
                count($this->options),
                self::MAX_OPTIONS_GROUP,
                self::class
            );
        }

        if (count($this->options) && count($this->optionGroups)) {
            throw new IncorrectOptionsConfigurationException(self::class);
        }
    }

    public function toArray(): array
    {
        $this->validate();

        $this
            ->handleOptions()
            ->handleInitialOptions()
            ->handleConfirm()
            ->handleFocusOnLoad()
            ->handleMaxSelectedItems()
            ->handleActionId()
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
