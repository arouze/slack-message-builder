<?php

namespace Arouze\SlackMessageBuilder\Objects;

use Arouze\SlackMessageBuilder\Exceptions\TooLongButtonObjectTextException;

class TextObject implements ObjectInterface
{
    // @see : https://api.slack.com/reference/block-kit/composition-objects#text

    public const TEXT_OBJECT_TYPE_PLAIN_TEXT = 'plain_text';
    public const TEXT_OBJECT_TYPE_MARKDOWN = 'mrkdwn';

    private const MAXIMUM_TEXT_LENGTH = 3000;

    private string $type = self::TEXT_OBJECT_TYPE_PLAIN_TEXT;

    private string $text = '';

    public function toArray(): array
    {
        return [
            'type' => $this->type,
            'text' => $this->text
        ];
    }

    public function getType(): string
    {
        return $this->type;
    }

    public function setType(string $type): self
    {
        $this->type = $type;

        return $this;
    }

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
}
