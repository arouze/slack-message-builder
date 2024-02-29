<?php

namespace Arouze\SlackMessageBuilder\Blocks;

use Arouze\SlackMessageBuilder\Common\BlockIdInterface;
use Arouze\SlackMessageBuilder\Common\BlockIdTrait;
use Arouze\SlackMessageBuilder\Elements\RichText\RichTextElementInterface;

class RichTextBlock implements BlockInterface, BlockIdInterface
{
    use BlockIdTrait;

    // @doc : https://api.slack.com/reference/block-kit/blocks#rich_text
    private const RICH_TEXT_TYPE = 'rich_text';

    private array $elements = [];

    public function addElement(RichTextElementInterface $element): self
    {
        $this->elements[] = $element->toArray();

        return $this;
    }

    public function toArray(): array
    {
        $block = [
            'type' => self::RICH_TEXT_TYPE,
            'elements' => $this->elements
        ];

        return $this->addBlockIdToArray($block);
    }
}
