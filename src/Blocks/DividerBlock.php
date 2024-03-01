<?php

namespace Arouze\SlackMessageBuilder\Blocks;

class DividerBlock implements BlockInterface
{
    // @doc : https://api.slack.com/reference/block-kit/blocks#divider
    private const DIVIDER_TYPE = 'divider';

    public function toArray(): array
    {
        return [
            'type' => self::DIVIDER_TYPE
        ];
    }
}
