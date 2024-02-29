<?php

namespace Arouze\SlackMessageBuilder\Blocks;

use Arouze\SlackMessageBuilder\Common\BlockIdInterface;
use Arouze\SlackMessageBuilder\Common\BlockIdTrait;
use Arouze\SlackMessageBuilder\Elements\DateTimePickerElement;
use Arouze\SlackMessageBuilder\Elements\ElementInterface;
use Arouze\SlackMessageBuilder\Exceptions\IncompatibleElementException;
use Arouze\SlackMessageBuilder\Exceptions\TooLongTextException;
use Arouze\SlackMessageBuilder\Objects\TextObject;

class InputBlock implements BlockInterface, BlockIdInterface
{
    use BlockIdTrait;

    // @doc : https://api.slack.com/reference/block-kit/blocks#input
    private const INPUT_TYPE = 'input';

    private const MAX_LABEL_LENGTH = 2000;

    private const MAX_HINT_LENGTH = 2000;

    private const COMPATIBLE_ELEMENTS = [
        DateTimePickerElement::class
    ];

    private TextObject $label;

    private ElementInterface $element;

    private bool $dispatchAction = false;

    private ?TextObject $hint = null;

    private bool $optional = false;

    public function toArray(): array
    {
        $block = [
            'type' => self::INPUT_TYPE,
            'label' => $this->label->toArray(),
            'element' => $this->element->toArray(),
            'dispatch_action' => $this->dispatchAction,
            'optional' => $this->optional
        ];

        return $this->addBlockIdToArray($block);
    }

    public function setLabel(TextObject $label): self
    {
        if (strlen($label->getText()) > self::MAX_LABEL_LENGTH) {
            throw new TooLongTextException(strlen($label->getText()), self::MAX_LABEL_LENGTH);
        }

        $this->label = $label;

        return $this;
    }

    public function setElement(ElementInterface $element): self
    {
        if (!in_array(get_class($element), self::COMPATIBLE_ELEMENTS)) {
            throw new IncompatibleElementException(
                get_class($element),
                self::class,
                self::COMPATIBLE_ELEMENTS
            );
        }

        $this->element = $element;

        return $this;
    }

    public function enableDispatchAction(): self
    {
        $this->dispatchAction = true;

        return $this;
    }

    public function enableOptional(): self
    {
        $this->optional = true;

        return $this;
    }

    public function setHint(?TextObject $hint): self
    {
        if (strlen($hint->getText()) > self::MAX_HINT_LENGTH) {
            throw new TooLongTextException(strlen($hint->getText()), self::MAX_HINT_LENGTH);
        }

        $this->hint = $hint;

        return $this;
    }
}
