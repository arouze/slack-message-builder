<?php

namespace Arouze\SlackMessageBuilder\Blocks;

use Arouze\SlackMessageBuilder\Accessories\AccessoryInterface;
use Arouze\SlackMessageBuilder\Objects\TextObject;

class SectionBlock implements BlockInterface
{
    private const SECTION_TYPE = 'section';
    // @doc https://api.slack.com/reference/block-kit/blocks#section

    private TextObject $textObject;

    private ?AccessoryInterface $accessory = null;
    public function toArray(): array
    {
        $block = [
            'type' => self::SECTION_TYPE,
            'text' => $this->textObject->toArray()
        ];

        if (!is_null($this->accessory)) {
            $block = array_merge(
                $block,
                [
                    'accessory' => $this->accessory->toArray()
                ]
            );
        }

        return $block;
    }

    public function setTextObject(TextObject $textObject): self
    {
        $this->textObject = $textObject;

        return $this;
    }

    public function setAccessory(?AccessoryInterface $accessory): SectionBlock
    {
        $this->accessory = $accessory;

        return $this;
    }
}
