<?php

namespace Arouze\SlackMessageBuilder\Elements;

use Arouze\SlackMessageBuilder\Blocks\ActionBlock;
use Arouze\SlackMessageBuilder\Blocks\InputBlock;
use Arouze\SlackMessageBuilder\Blocks\SectionBlock;
use Arouze\SlackMessageBuilder\Common\ActionIdInterface;
use Arouze\SlackMessageBuilder\Common\ActionIdTrait;
use Arouze\SlackMessageBuilder\Exceptions\TooLongTextException;
use Arouze\SlackMessageBuilder\Objects\TextObject;

class DatePickerElement implements BlockElementsInterface, ActionIdInterface, ConfirmableElementInterface, FocusableInterface // phpcs:ignore
{
    use ActionIdTrait;
    use ConfirmElementTrait;
    use FocusOnLoadTrait;

    // @doc : https://api.slack.com/reference/block-kit/block-elements#datepicker
    private const DATE_PICKER_ELEMENT_TYPE = 'datepicker';

    private const MAX_PLACEHOLDER_LENGTH = 150;

    private array $block = [
        'type' => self::DATE_PICKER_ELEMENT_TYPE
    ];

    private ?string $initialDate = null;

    private ?TextObject $placeholder = null;

    public function setInitialDate(?string $initialDate): DatePickerElement
    {
        $this->initialDate = $initialDate;

        return $this;
    }

    public function setPlaceholder(?TextObject $placeholder): DatePickerElement
    {
        $this->placeholder = $placeholder;

        return $this;
    }

    private function handleInitialDate(): self
    {
        if (!is_null($this->initialDate)) {
            $this->block['initial_date'] = $this->initialDate;
        }

        return $this;
    }

    private function handlePlaceHolder(): self
    {
        if (!is_null($this->placeholder)) {
            $this->block['placeholder'] = $this->placeholder->toArray();
        }

        return $this;
    }

    private function validate(): void
    {
        if (!is_null($this->placeholder) && strlen($this->placeholder->getText()) > self::MAX_PLACEHOLDER_LENGTH) {
            throw new TooLongTextException(strlen($this->placeholder->getText()), self::MAX_PLACEHOLDER_LENGTH);
        }
    }

    public function toArray(): array
    {
        $this->validate();

        $this
            ->handleInitialDate()
            ->handlePlaceHolder()
            ->handleConfirm()
            ->handleFocusOnLoad()
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
