<?php

namespace Arouze\SlackMessageBuilder\Blocks;

use Arouze\SlackMessageBuilder\Elements\ElementInterface;
use Arouze\SlackMessageBuilder\Exceptions\TooMuchElementsException;

class ActionBlock implements BlockInterface
{
    // @see : https://api.slack.com/reference/block-kit/blocks#actions
    private const ACTIONS_TYPE = 'actions';

    public const MAX_ELEMENTS = 25;

    private array $elements = [];

    public function addElement(ElementInterface $element): self
    {
        if (count($this->elements) >= self::MAX_ELEMENTS) {
            throw new TooMuchElementsException(count($this->elements));
        }

        $this->elements[] = $element->toArray();

        return $this;
    }

    public function toArray(): array
    {
        return [
            'type' => self::ACTIONS_TYPE,
            'elements' => $this->elements
        ];
    }
}
