<?php

namespace Arouze\SlackMessageBuilder\Elements;

use Arouze\SlackMessageBuilder\Blocks\ActionBlock;
use Arouze\SlackMessageBuilder\Blocks\InputBlock;
use Arouze\SlackMessageBuilder\Blocks\SectionBlock;
use Arouze\SlackMessageBuilder\Common\ActionIdInterface;
use Arouze\SlackMessageBuilder\Common\ActionIdTrait;

class TimePickerElement implements BlockElementsInterface, ActionIdInterface, ConfirmableElementInterface, FocusableInterface // phpcs:ignore
{
    use ActionIdTrait;
    use ConfirmElementTrait;
    use FocusOnLoadTrait;
    use PlaceHolderTrait;

    // @doc : https://api.slack.com/reference/block-kit/block-elements#timepicker

    private const TIME_PICKER_TYPE = 'timepicker';

    private const PLACEHOLDER_MAX_LENGTH = 150;

    private array $block = [
        'type' => self::TIME_PICKER_TYPE
    ];

    private ?string $initialTime = null;

    private ?string $timeZone = null;

    private function validate(): void
    {
        $this->validatePlaceHolder(self::PLACEHOLDER_MAX_LENGTH);
    }

    private function handleInitialTime(): self
    {
        if (!is_null($this->initialTime)) {
            $this->block['initial_time'] = $this->initialTime;
        }

        return $this;
    }

    private function handleTimezone(): self
    {
        if (!is_null($this->timeZone)) {
            $this->block['timezone'] = $this->timeZone;
        }

        return $this;
    }

    public function setInitialTime(?string $initialTime): TimePickerElement
    {
        $this->initialTime = $initialTime;

        return $this;
    }

    public function setTimeZone(?string $timeZone): TimePickerElement
    {
        $this->timeZone = $timeZone;

        return $this;
    }

    public function toArray(): array
    {
        $this->validate();

        $this
            ->handleActionId()
            ->handleInitialTime()
            ->handleConfirm()
            ->handleFocusOnLoad()
            ->handlePlaceHolder()
            ->handleTimezone();

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
