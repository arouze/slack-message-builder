<?php

namespace Arouze\SlackMessageBuilder\Elements\RichText;

class RichTextListElement implements RichTextElementInterface
{
    // @doc : https://api.slack.com/reference/block-kit/blocks#rich_text_list
    private const RICH_TEXT_LIST_ELEMENT_TYPE = 'rich_text_list';

    public const STYLE_BULLET = 'bullet';

    public const STYLE_ORDERED = 'ordered';

    private array $block = [
        'type' => self::RICH_TEXT_LIST_ELEMENT_TYPE
    ];

    private array $elements = [];

    private string $style = self::STYLE_BULLET;

    private ?int $indent = null;

    private ?int $offset = null;

    private ?int $border = null;

    public function addElement(RichTextSectionElement $element): self
    {
        $this->elements[] = $element;

        return $this;
    }

    public function setStyle(string $style): self
    {
        $this->style = $style;

        return $this;
    }

    public function setIndent(?int $indent): self
    {
        $this->indent = $indent;

        return $this;
    }

    public function setOffset(?int $offset): self
    {
        $this->offset = $offset;

        return $this;
    }

    public function setBorder(?int $border): self
    {
        $this->border = $border;

        return $this;
    }

    private function handleIndent(): self
    {
        if (!is_null($this->indent)) {
            $this->block['indent'] = $this->indent;
        }

        return $this;
    }

    private function handleOffset(): self
    {
        if (!is_null($this->offset)) {
            $this->block['offset'] = $this->offset;
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

    private function handleElements(): self
    {
        /** @var RichTextSectionElement $element */
        foreach ($this->elements as $element) {
            $this->block['elements'][] = $element->toArray();
        }

        return $this;
    }

    public function toArray(): array
    {
        $this
            ->handleElements()
            ->handleIndent()
            ->handleOffset()
            ->handleBorder();

        $this->block['style'] = $this->style;

        return $this->block;
    }
}
