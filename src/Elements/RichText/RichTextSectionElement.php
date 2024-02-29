<?php

namespace Arouze\SlackMessageBuilder\Elements\RichText;

use Arouze\SlackMessageBuilder\Objects\RichText\RichTextObjectTypeInterface;

class RichTextSectionElement implements RichTextElementInterface
{
    // @doc : https://api.slack.com/reference/block-kit/blocks#rich_text_section
    private const RICH_TEXT_SECTION_ELEMENT_TYPE = 'rich_text_section';

    private array $elements = [];

    public function addElement(RichTextObjectTypeInterface $element): self
    {
        $this->elements[] = $element->toArray();

        return $this;
    }

    public function toArray(): array
    {
        return [
            'type' => self::RICH_TEXT_SECTION_ELEMENT_TYPE,
            'elements' => $this->elements
        ];
    }
}
