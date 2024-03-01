<?php

namespace Arouze\SlackMessageBuilder\Objects;

class ButtonTextObject extends TextObject
{
    // @see : https://api.slack.com/reference/block-kit/block-elements#button
    private string $type = TextObject::TEXT_OBJECT_TYPE_PLAIN_TEXT;

    private string $text = '';

    public function getText(): string
    {
        return $this->text;
    }

    public function setText(string $text): self
    {
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
