<?php

namespace Arouze\SlackMessageBuilder\Elements;

use Arouze\SlackMessageBuilder\Blocks\InputBlock;
use Arouze\SlackMessageBuilder\Common\ActionIdInterface;
use Arouze\SlackMessageBuilder\Common\ActionIdTrait;
use Arouze\SlackMessageBuilder\Exceptions\IncorrectFieldLengthException;

class PlainTextInputElement implements BlockElementsInterface, ActionIdInterface
{
    use ActionIdTrait;
    use DispatchActionConfigTrait;
    use FocusOnLoadTrait;
    use InitialValueTrait;
    use PlaceHolderTrait;

    //@see : https://api.slack.com/reference/block-kit/block-elements#input
    private const PLAIN_TEXT_INPUT_TYPE = 'plain_text_input';

    private const MAX_PLACEHOLDER_LENGTH = 150;

    private const MINIMAL_MIN_LENGTH = 0;

    private const MAXIMAL_MIN_LENGTH = 3000;

    private const MINIMAL_MAX_LENGTH = 1;

    private const MAXIMAL_MAX_LENGTH = 3000;

    private array $block = [
        'type' => self::PLAIN_TEXT_INPUT_TYPE
    ];

    private bool $multiline = false;

    private ?int $minLength = null;

    private ?int $maxLength = null;

    public function enableMultiline(): self
    {
        $this->multiline = true;

        return $this;
    }

    public function setMinLength(?int $minLength): self
    {
        $this->minLength = $minLength;

        return $this;
    }

    public function setMaxLength(?int $maxLength): self
    {
        $this->maxLength = $maxLength;

        return $this;
    }

    private function handleMultiline(): self
    {
        if ($this->multiline === true) {
            $this->block['multiline'] = true;
        }

        return $this;
    }

    private function handleMinLength(): self
    {
        if (!is_null($this->minLength)) {
            $this->block['min_length'] = $this->minLength;
        }

        return $this;
    }

    private function handleMaxLength(): self
    {
        if (!is_null($this->maxLength)) {
            $this->block['max_length'] = $this->maxLength;
        }

        return $this;
    }

    private function validate(): void
    {
        $this->validatePlaceHolder(self::MAX_PLACEHOLDER_LENGTH);

        if (
            !is_null($this->minLength) &&
            ($this->minLength < self::MINIMAL_MIN_LENGTH || $this->minLength > self::MAXIMAL_MIN_LENGTH)
        ) {
            throw new IncorrectFieldLengthException(
                'min_length',
                self::MINIMAL_MIN_LENGTH,
                self::MAXIMAL_MIN_LENGTH
            );
        }

        if (
            !is_null($this->maxLength) &&
            ($this->maxLength < self::MINIMAL_MAX_LENGTH || $this->maxLength > self::MAXIMAL_MAX_LENGTH)
        ) {
            throw new IncorrectFieldLengthException(
                'max_length',
                self::MINIMAL_MAX_LENGTH,
                self::MAXIMAL_MAX_LENGTH
            );
        }
    }

    public function toArray(): array
    {
        $this->validate();

        $this
            ->handleActionId()
            ->handleInitialValue()
            ->handleMinLength()
            ->handleMaxLength()
            ->handleMultiline()
            ->handleDispatchActionConfig()
            ->handleFocusOnLoad()
            ->handlePlaceHolder();

        return $this->block;
    }

    public function getCompatibleBlocks(): array
    {
        return [
            InputBlock::class
        ];
    }
}
