<?php

namespace Arouze\SlackMessageBuilder\Objects\RichText;

class UserType implements RichTextObjectTypeInterface
{
    use RichTextStyleTrait;

    // @doc : https://api.slack.com/reference/block-kit/blocks#element-types
    private const USER_TYPE = 'user';

    private array $block = [
        'type' => self::USER_TYPE
    ];

    private const AVAILABLE_STYLES = [
        self::STYLE_BOLD,
        self::STYLE_ITALIC,
        self::STYLE_STRIKE,
        self::STYLE_HIGHLIGHT,
        self::STYLE_CLIENT_HIGHLIGHT,
        self::STYLE_UNLINK,
    ];

    private string $userId;

    public function setUserId(string $userId): self
    {
        $this->userId = $userId;

        return $this;
    }

    public function toArray(): array
    {
        $this->block['user_id'] = $this->userId;

        return $this->block;
    }
}
