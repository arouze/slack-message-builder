<?php

namespace Arouze\SlackMessageBuilder\Objects\RichText;

class UserGroupType implements RichTextObjectTypeInterface
{
    use RichTextStyleTrait;

    // @doc : https://api.slack.com/reference/block-kit/blocks#element-types
    private const USER_GROUP_TYPE = 'usergroup';

    private array $block = [
        'type' => self::USER_GROUP_TYPE
    ];

    private const AVAILABLE_STYLES = [
        self::STYLE_BOLD,
        self::STYLE_ITALIC,
        self::STYLE_STRIKE,
        self::STYLE_HIGHLIGHT,
        self::STYLE_CLIENT_HIGHLIGHT,
        self::STYLE_UNLINK,
    ];

    private string $userGroupId;

    public function setUserGroupId(string $userGroupId): self
    {
        $this->userGroupId = $userGroupId;

        return $this;
    }

    public function toArray(): array
    {
        $this->block['usergroup_id'] = $this->userGroupId;

        return $this->block;
    }
}
