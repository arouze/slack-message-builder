<?php

namespace Arouze\SlackMessageBuilder\Objects\RichText;

class ChannelType implements RichTextObjectTypeInterface
{
    use RichTextStyleTrait;

    // @doc : https://api.slack.com/reference/block-kit/blocks#element-types
    private const CHANNEL_TYPE = 'channel';

    private const AVAILABLE_STYLES = [
        self::STYLE_BOLD,
        self::STYLE_ITALIC,
        self::STYLE_STRIKE,
        self::STYLE_HIGHLIGHT,
        self::STYLE_CLIENT_HIGHLIGHT,
        self::STYLE_UNLINK
    ];

    private array $block = [
        'type' => self::CHANNEL_TYPE
    ];

    private string $channelId;

    public function setChannelId(string $channelId): self
    {
        $this->channelId = $channelId;

        return $this;
    }

    public function toArray(): array
    {
        $this->block['channel_id'] = $this->channelId;

        return $this->block;
    }
}
