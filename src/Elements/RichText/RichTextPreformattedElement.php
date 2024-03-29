<?php

namespace Arouze\SlackMessageBuilder\Elements\RichText;

use Arouze\SlackMessageBuilder\Objects\RichText\RichTextObjectTypeInterface;

class RichTextPreformattedElement implements RichTextElementInterface
{
    use RichTestBorderTrait;

    // @doc : https://api.slack.com/reference/block-kit/blocks#rich_text_preformatted
    private const RICH_TEXT_PREFORMATTED_ELEMENT_TYPE = 'rich_text_preformatted';

    private array $block = [
        'type' => self::RICH_TEXT_PREFORMATTED_ELEMENT_TYPE
    ];

    private array $elements = [];

    public function addElement(RichTextObjectTypeInterface $element): self
    {
        $this->elements[] = $element;

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

    public function toArray(): array
    {
        $this
        ->handleElements()
        ->handleBorder();

        return $this->block;
    }
}
