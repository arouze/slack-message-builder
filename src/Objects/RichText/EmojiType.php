<?php

namespace Arouze\SlackMessageBuilder\Objects\RichText;

class EmojiType implements RichTextObjectTypeInterface
{
    // @doc : https://api.slack.com/reference/block-kit/blocks#element-types
    private const EMOJI_TYPE = 'emoji';

    private string $name;

    public function setName(string $name): EmojiType
    {
        $this->name = $name;

        return $this;
    }

    public function toArray(): array
    {
        return [
            'type' => self::EMOJI_TYPE,
            'name' => $this->name
        ];
    }
}
