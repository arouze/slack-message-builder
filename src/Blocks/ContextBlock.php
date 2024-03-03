<?php

namespace Arouze\SlackMessageBuilder\Blocks;

use Arouze\SlackMessageBuilder\Common\BlockIdInterface;
use Arouze\SlackMessageBuilder\Common\BlockIdTrait;
use Arouze\SlackMessageBuilder\Elements\ImageElement;
use Arouze\SlackMessageBuilder\Exceptions\TooMuchElementsException;
use Arouze\SlackMessageBuilder\Objects\TextObject;

class ContextBlock implements BlockInterface, BlockIdInterface
{
    use BlockIdTrait;

    // @see : https://api.slack.com/reference/block-kit/blocks#context
    private const CONTEXT_TYPE = 'context';

    public const MAX_ELEMENTS = 10;

    private array $elements = [];

    public function addElement(TextObject|ImageElement $element): self
    {
        if (count($this->elements) >= self::MAX_ELEMENTS) {
            throw new TooMuchElementsException(count($this->elements), self::MAX_ELEMENTS, self::class);
        }

        $this->elements[] = $element->toArray();

        return $this;
    }

    public function toArray(): array
    {
        $block = [
            'type' => self::CONTEXT_TYPE,
            'elements' => $this->elements
        ];

        return $this->addBlockIdToArray($block);
    }
}
