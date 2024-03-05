<?php

namespace Arouze\SlackMessageBuilder\Elements\RichText;

use Arouze\SlackMessageBuilder\Objects\RichText\RichTextObjectTypeInterface;

class RichTextPreformattedElement implements RichTextElementInterface
{
    // @doc : https://api.slack.com/reference/block-kit/blocks#rich_text_preformatted
    private const RICH_TEXT_PREFORMATTED_ELEMENT_TYPE = 'rich_text_preformatted';

    private array $block = [
        'type' => self::RICH_TEXT_PREFORMATTED_ELEMENT_TYPE
    ];

    private array $elements = [];

    private ?int $border = null;

    public function addElement(RichTextObjectTypeInterface $element): self
    {
        $this->elements[] = $element;

        return $this;
    }

    public function setBorder(?int $border): RichTextPreformattedElement
    {
        $this->border = $border;

        return $this;
    }

    private function handleElements(): self
    {
        /** @var RichTextObjectTypeInterface $element */
        foreach ($this->elements as $element) {
            $this->block['elements'][] = $element->toArray();
        }

        return $this;
    }

    private function handleBorder(): self
    {
        if (!is_null($this->border)) {
            $this->block['border'] = $this->border;
        }

        return $this;
    }

    public function toArray(): array
    {
        $this
        ->handleElements()
        ->handleBorder();

        return $this->block;
    }
}
