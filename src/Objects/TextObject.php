<?php

namespace Arouze\SlackMessageBuilder\Objects;

use Arouze\SlackMessageBuilder\Exceptions\TooLongTextException;
use Arouze\SlackMessageBuilder\Exceptions\TooShortTextException;

class TextObject implements ObjectInterface
{
    // @see : https://api.slack.com/reference/block-kit/composition-objects#text

    public const TEXT_OBJECT_TYPE_PLAIN_TEXT = 'plain_text';
    public const TEXT_OBJECT_TYPE_MARKDOWN = 'mrkdwn';

    private const MAXIMUM_TEXT_LENGTH = 3000;

    private const MINIMUM_TEXT_LENGTH = 1;

    private array $block = [];

    private string $type = self::TEXT_OBJECT_TYPE_PLAIN_TEXT;

    private string $text = '';

    private bool $emoji = false;

    private bool $verbatim = false;

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
        $this->text = $text;

        return $this;
    }

    public function escapeEmoji(): self
    {
        $this->emoji = true;

        return $this;
    }

    public function enableVerbatim(): self
    {
        $this->verbatim = true;

        return $this;
    }

    private function validate(): void
    {
        $textLength = strlen($this->text);

        if ($textLength > self::MAXIMUM_TEXT_LENGTH) {
            throw new TooLongTextException($textLength, self::MAXIMUM_TEXT_LENGTH);
        }

        if ($textLength < self::MINIMUM_TEXT_LENGTH) {
            throw new TooShortTextException($textLength, self::MINIMUM_TEXT_LENGTH, 'text');
        }
    }

    private function handleEmoji(): self
    {
        if ($this->emoji === true && $this->type === self::TEXT_OBJECT_TYPE_PLAIN_TEXT) {
            $this->block['emoji'] = true;
        }

        return $this;
    }

    private function handleVerbatim(): self
    {
        if ($this->verbatim === true && $this->type === self::TEXT_OBJECT_TYPE_MARKDOWN) {
            $this->block['verbatim'] = true;
        }

        return $this;
    }

    public function toArray(): array
    {
        $this->validate();

        $this
            ->handleEmoji()
            ->handleVerbatim()
        ;

        $this->block['type'] = $this->type;
        $this->block['text'] = $this->text;

        return $this->block;
    }
}
