<?php

namespace Arouze\SlackMessageBuilder\Objects;

use Arouze\SlackMessageBuilder\Exceptions\TooLongButtonObjectTextException;

class ButtonTextObject extends TextObject
{
    // @see : https://api.slack.com/reference/block-kit/block-elements#button
    public const MAXIMUM_TEXT_LENGTH = 75;

    private string $type = TextObject::TEXT_OBJECT_TYPE_PLAIN_TEXT;

    private string $text = '';

    public function getText(): string
    {
        return $this->text;
    }

    public function setText(string $text): self
    {
        if (strlen($text) >= self::MAXIMUM_TEXT_LENGTH) {
            throw new TooLongButtonObjectTextException(strlen($text));
        }

        $this->text = $text;

        return $this;
    }

    public function toArray(): array
    {
        return [
            'type' => $this->type,
            'text' => $this->text
        ];
    }
}
