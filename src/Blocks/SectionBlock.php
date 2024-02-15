<?php

namespace Arouze\SlackMessageBuilder\Blocks;

use Arouze\SlackMessageBuilder\Accessories\AccessoryInterface;
use Arouze\SlackMessageBuilder\Exceptions\MissingFieldException;
use Arouze\SlackMessageBuilder\Objects\TextObject;

class SectionBlock implements BlockInterface
{
    private const SECTION_TYPE = 'section';
    // @doc https://api.slack.com/reference/block-kit/blocks#section

    private ?TextObject $textObject = null;

    private ?AccessoryInterface $accessory = null;

    private ?string $blockId = null;

    private array $block = [
        'type' => self::SECTION_TYPE
    ];
    private array $fields = [];
    public function toArray(): array
    {
        $this->validate();

        $this
            ->handleTextObject()
            ->handleBlockId()
            ->handleAccessory()
            ->handleFields();

        return $this->block;
    }

    private function handleTextObject(): self
    {
        if (!is_null($this->textObject)) {
            $this->block['text'] = $this->textObject->toArray();
        }

        return $this;
    }
    private function handleBlockId(): self
    {
        if (!is_null($this->blockId)) {
            $this->block['block_id'] = $this->blockId;
        }

        return $this;
    }
    private function handleAccessory(): self
    {
        if (!is_null($this->accessory)) {
            $this->block['accessory'] = $this->accessory->toArray();
        }

        return $this;
    }
    private function handleFields(): self
    {
        if (count($this->fields)) {
            $this->block['fields'] = $this->fields;
        }

        return $this;
    }

    private function validate(): void
    {
        if (is_null($this->textObject) && count($this->fields) === 0) {
            throw new MissingFieldException(self::class, 'text, fields');
        }
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

    public function addFields(TextObject $textObject): SectionBlock
    {
        $this->fields[] = $textObject->toArray();

        return $this;
    }

    public function setBlockId(?string $blockId): SectionBlock
    {
        $this->blockId = $blockId;
        return $this;
    }
}
