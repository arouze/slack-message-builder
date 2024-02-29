<?php

namespace Arouze\SlackMessageBuilder\Objects\RichText;

class ChannelType implements RichTextObjectTypeInterface
{
    // @doc : https://api.slack.com/reference/block-kit/blocks#element-types
    private const CHANNEL_TYPE = 'channel';

    public const STYLE_BOLD = 'bold';
    public const STYLE_ITALIC = 'italic';
    public const STYLE_STRIKE = 'strike';
    public const STYLE_HIGHLIGHT = 'highlight';
    public const STYLE_CLIENT_HIGHLIGHT = 'client_highlight';
    public const STYLE_UNLINK = 'unlink';

    private string $channelId;

    private ?string $style = null;

    public function setChannelId(string $channelId): self
    {
        $this->channelId = $channelId;

        return $this;
    }

    public function setStyle(?string $style): ChannelType
    {
        $this->style = $style;
        return $this;
    }

    public function toArray(): array
    {
        $block = [
            'type' => self::CHANNEL_TYPE,
            'channel_id' => $this->channelId
        ];

        if (!is_null($this->style)) {
            return array_merge(
                $block,
                [
                    'style' => $this->style
                ]
            );
        }

        return $block;
    }
}
