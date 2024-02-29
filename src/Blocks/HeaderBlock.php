<?php

namespace Arouze\SlackMessageBuilder\Blocks;

use Arouze\SlackMessageBuilder\Common\BlockIdInterface;
use Arouze\SlackMessageBuilder\Common\BlockIdTrait;
use Arouze\SlackMessageBuilder\Exceptions\TooLongHeaderTextException;
use Arouze\SlackMessageBuilder\Objects\TextObject;

class HeaderBlock implements BlockInterface, BlockIdInterface
{
    use BlockIdTrait;
    private const HEADER_TYPE = 'header';

    public const MAX_TEXT_LENGTH = 150;

    private TextObject $text;

    public function toArray(): array
    {
        $block = [
            'type' => self::HEADER_TYPE,
            'text' => $this->text->toArray()
        ];

        if (is_null($this->blockId)) {
            return $block;
        }

        return array_merge(
            $block,
            [
                'block_id' => $this->blockId

            ]
        );
    }

    public function setTextObject(TextObject $text): HeaderBlock
    {
        if (strlen($text->getText()) > self::MAX_TEXT_LENGTH) {
            throw new TooLongHeaderTextException(strlen($text->getText()));
        }

        $this->text = $text;

        return $this;
    }
}
