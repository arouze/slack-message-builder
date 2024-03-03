<?php

namespace Arouze\SlackMessageBuilder\Elements;

use Arouze\SlackMessageBuilder\Blocks\InputBlock;
use Arouze\SlackMessageBuilder\Common\ActionIdInterface;
use Arouze\SlackMessageBuilder\Common\ActionIdTrait;
use Arouze\SlackMessageBuilder\Exceptions\IncorrectMinMaxValueException;

class NumberInputElement implements BlockElementsInterface, ActionIdInterface, FocusableInterface
{
    use ActionIdTrait;
    use DispatchActionConfigTrait;
    use FocusOnLoadTrait;
    use InitialValueTrait;
    use PlaceHolderTrait;

    // @doc : https://api.slack.com/reference/block-kit/block-elements#number

    private const NUMBER_INPUT_TYPE = 'number_input';

    private const MAX_PLACEHOLDER_LENGTH = 150;

    private array $block = [
        'type' => self::NUMBER_INPUT_TYPE
    ];

    private bool $isDecimalAllowed = false;

    private ?string $minValue = null;

    private ?string $maxValue = null;

    public function enableDecimal(): self
    {
        $this->isDecimalAllowed = true;

        return $this;
    }

    public function setMinValue(?string $minValue): NumberInputElement
    {
        $this->minValue = $minValue;

        return $this;
    }

    public function setMaxValue(?string $maxValue): NumberInputElement
    {
        $this->maxValue = $maxValue;

        return $this;
    }

    private function handleMinValue(): self
    {
        if (!is_null($this->minValue)) {
            $this->block['min_value'] = $this->minValue;
        }

        return $this;
    }

    private function handleMaxValue(): self
    {
        if (!is_null($this->maxValue)) {
            $this->block['max_value'] = $this->maxValue;
        }

        return $this;
    }
    private function validate(): void
    {
        $this->validatePlaceHolder(self::MAX_PLACEHOLDER_LENGTH);

        if (
            !is_null($this->minValue) && !is_null($this->maxValue) &&
            (int) $this->minValue > (int) $this->maxValue
        ) {
            throw new IncorrectMinMaxValueException();
        }
    }

    public function toArray(): array
    {
        $this->validate();

        $this
            ->handleInitialValue()
            ->handlePlaceHolder()
            ->handleFocusOnLoad()
            ->handleDispatchActionConfig()
            ->handleMinValue()
            ->handleMaxValue()
            ->handleActionId();

        $this->block['is_decimal_allowed'] = $this->isDecimalAllowed;

        return $this->block;
    }

    public function getCompatibleBlocks(): array
    {
        return [
            InputBlock::class
        ];
    }
}
