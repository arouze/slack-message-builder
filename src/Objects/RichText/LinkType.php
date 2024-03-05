<?php

namespace Arouze\SlackMessageBuilder\Objects\RichText;

use Arouze\SlackMessageBuilder\Elements\StyleTrait;

class LinkType implements RichTextObjectTypeInterface
{
    use RichTextStyleTrait;

    // @doc : https://api.slack.com/reference/block-kit/blocks#element-types
    private const LINK_TYPE = 'link';

    private const AVAILABLE_STYLES = [
        self::STYLE_BOLD,
        self::STYLE_ITALIC,
        self::STYLE_STRIKE,
        self::STYLE_CODE
    ];

    private array $block = [
        'type' => self::LINK_TYPE
    ];

    private string $url;

    private ?string $text = null;

    private ?bool $unsafe = null;

    public function setUrl(string $url): self
    {
        $this->url = $url;

        return $this;
    }

    public function setText(?string $text): self
    {
        $this->text = $text;

        return $this;
    }

    public function markHasUnsafeLink(): self
    {
        $this->unsafe = true;

        return $this;
    }

    public function markHasSafeLink(): self
    {
        $this->unsafe = false;

        return $this;
    }

    private function handleText(): self
    {
        if (!is_null($this->text)) {
            $this->block['text'] = $this->text;
        }

        return $this;
    }

    private function handleUnsafe(): self
    {
        if (!is_null($this->unsafe)) {
            $this->block['unsafe'] = $this->unsafe;
        }

        return $this;
    }

    public function toArray(): array
    {
        $this->block['url'] = $this->url;

        $this
            ->handleText()
            ->handleUnsafe();

        return $this->block;
    }
}
