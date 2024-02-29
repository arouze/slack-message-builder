<?php

namespace Arouze\SlackMessageBuilder\Blocks;

use Arouze\SlackMessageBuilder\Common\BlockIdInterface;
use Arouze\SlackMessageBuilder\Common\BlockIdTrait;
use Arouze\SlackMessageBuilder\Exceptions\MissingFieldException;
use Arouze\SlackMessageBuilder\Exceptions\TooFieldsException;
use Arouze\SlackMessageBuilder\Exceptions\TooLongBuildIdException;
use Arouze\SlackMessageBuilder\Exceptions\TooLongFieldTextException;
use Arouze\SlackMessageBuilder\Objects\ObjectInterface;
use Arouze\SlackMessageBuilder\Objects\TextObject;

class SectionBlock implements BlockInterface, BlockIdInterface
{
    use BlockIdTrait;

    private const SECTION_TYPE = 'section';
    // @doc https://api.slack.com/reference/block-kit/blocks#section

    public const MAX_FIELDS = 10;

    public const MAXIMUM_FIELD_TEXT_LENGTH = 2000;

    public const MAXIMUM_BUILD_ID_LENGTH = 255;

    private ?TextObject $textObject = null;

    private ?ObjectInterface $accessory = null;

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

        if (count($this->fields) > self::MAX_FIELDS) {
            throw new TooFieldsException(count($this->fields));
        }

        if (!is_null($this->blockId) && strlen($this->blockId) > self::MAXIMUM_BUILD_ID_LENGTH) {
            throw new TooLongBuildIdException(strlen($this->blockId));
        }

        $this->validateTextFieldLength();
    }

    private function validateTextFieldLength(): void
    {
        foreach ($this->fields as $field) {
            if (strlen($field['text']) > self::MAXIMUM_FIELD_TEXT_LENGTH) {
                throw new TooLongFieldTextException(strlen($field['text']));
            }
        }
    }

    public function setTextObject(TextObject $textObject): self
    {
        $this->textObject = $textObject;

        return $this;
    }

    public function setAccessory(?ObjectInterface $accessory): SectionBlock
    {
        $this->accessory = $accessory;

        return $this;
    }

    public function addFields(TextObject $textObject): SectionBlock
    {
        $this->fields[] = $textObject->toArray();

        return $this;
    }
}
