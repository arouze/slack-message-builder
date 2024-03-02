<?php

namespace Arouze\SlackMessageBuilder\Elements;

use Arouze\SlackMessageBuilder\Blocks\ActionBlock;
use Arouze\SlackMessageBuilder\Blocks\InputBlock;
use Arouze\SlackMessageBuilder\Common\ActionIdInterface;
use Arouze\SlackMessageBuilder\Common\ActionIdTrait;
use Arouze\SlackMessageBuilder\Exceptions\IncorrectTimeStampException;

class DateTimePickerElement implements BlockElementsInterface, ActionIdInterface, ConfirmableElementInterface, FocusableInterface // phpcs:ignore
{
    use ActionIdTrait;
    use ConfirmElementTrait;
    use FocusOnLoadTrait;

    private const DATETIME_PICKER_ELEMENT_TYPE = 'datetimepicker';

    private const INITIAL_DATE_TIME_LENGTH = 10;

    private array $block = [
        'type' => self::DATETIME_PICKER_ELEMENT_TYPE
    ];

    private ?int $initialDateTime = null;


    public function setInitialDateTime(?int $initialDateTime): DateTimePickerElement
    {
        $this->initialDateTime = $initialDateTime;

        return $this;
    }
    private function handleInitialDateTime(): self
    {
        if (!is_null($this->initialDateTime)) {
            $this->block['initial_date_time'] = $this->initialDateTime;
        }

        return $this;
    }

    private function validate(): void
    {
        if (
            !is_null($this->initialDateTime) &&
            strlen((string)$this->initialDateTime) !== self::INITIAL_DATE_TIME_LENGTH
        ) {
            throw new IncorrectTimeStampException('initialDateTime');
        }
    }

    public function toArray(): array
    {
        $this->validate();

        $this
            ->handleActionId()
            ->handleInitialDateTime()
            ->handleConfirm()
            ->handleFocusOnLoad();

        return $this->block;
    }

    public function getCompatibleBlocks(): array
    {
        return [
            ActionBlock::class,
            InputBlock::class
        ];
    }
}
