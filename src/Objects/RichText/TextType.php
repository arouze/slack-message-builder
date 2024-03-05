<?php

namespace Arouze\SlackMessageBuilder\Objects\RichText;

class TextType implements RichTextObjectTypeInterface
{
    use RichTextStyleTrait;

    // @doc : https://api.slack.com/reference/block-kit/blocks#element-types
    private const TEXT_TYPE = 'text';

    private const AVAILABLE_STYLES = [
        self::STYLE_BOLD,
        self::STYLE_ITALIC,
        self::STYLE_STRIKE,
        self::STYLE_CODE,
    ];

    private array $block = [
        'type' => self::TEXT_TYPE
    ];

    public function toArray(): array
    {
        return $this->block;
    }
}
