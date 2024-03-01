<?php

namespace Arouze\SlackMessageBuilder\Objects;

use Arouze\SlackMessageBuilder\Exceptions\TooLongTextException;

class OptionObject implements ObjectInterface
{
    // @doc : https://api.slack.com/reference/block-kit/composition-objects#option

    private const MAX_TEXT_LENGTH = 75;

    private const MAX_VALUE_LENGTH = 75;

    private const MAX_DESCRIPTION_LENGTH = 75;

    private const MAX_URL_LENGTH = 3000;

    private array $block = [];

    private TextObject $text;

    private string $value;

    private ?TextObject $description = null;

    private ?string $url = null;

    public function setText(TextObject $text): OptionObject
    {
        $this->text = $text;

        return $this;
    }

    public function setValue(string $value): OptionObject
    {
        $this->value = $value;

        return $this;
    }

    public function setDescription(?TextObject $description): OptionObject
    {
        $this->description = $description;

        return $this;
    }

    public function setUrl(?string $url): OptionObject
    {
        $this->url = $url;

        return $this;
    }

    private function handleDescription(): self
    {
        if (!is_null($this->description)) {
            $this->block['description'] = $this->description->toArray();
        }

        return $this;
    }

    private function handleUrl(): self
    {
        if (!is_null($this->url)) {
            $this->block['url'] = $this->url;
        }

        return $this;
    }

    private function validate(): void
    {
        if (strlen($this->text->getText()) > self::MAX_TEXT_LENGTH) {
            throw new TooLongTextException(strlen($this->text->getText()), self::MAX_TEXT_LENGTH, 'text');
        }

        if (strlen($this->value) > self::MAX_VALUE_LENGTH) {
            throw new TooLongTextException(strlen($this->value), self::MAX_VALUE_LENGTH, 'value');
        }

        if (!is_null($this->description) && strlen($this->description->getText()) > self::MAX_DESCRIPTION_LENGTH) {
            throw new TooLongTextException(
                strlen($this->description->getText()),
                self::MAX_DESCRIPTION_LENGTH,
                'description'
            );
        }

        if (!is_null($this->url) && strlen($this->url) > self::MAX_URL_LENGTH) {
            throw new TooLongTextException(
                strlen($this->url),
                self::MAX_URL_LENGTH,
                'url'
            );
        }
    }

    public function toArray(): array
    {
        $this->validate();

        $this->block['text'] = $this->text->toArray();
        $this->block['value'] = $this->value;

        $this
            ->handleDescription()
            ->handleUrl()
        ;

        return $this->block;
    }
}
