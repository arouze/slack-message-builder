<?php

namespace Arouze\SlackMessageBuilder\Elements;

use Arouze\SlackMessageBuilder\Blocks\ActionBlock;
use Arouze\SlackMessageBuilder\Blocks\SectionBlock;
use Arouze\SlackMessageBuilder\Common\ActionIdInterface;
use Arouze\SlackMessageBuilder\Common\ActionIdTrait;
use Arouze\SlackMessageBuilder\Exceptions\TooLongTextException;
use Arouze\SlackMessageBuilder\Objects\ButtonTextObject;

class ButtonElement implements BlockElementsInterface, ActionIdInterface, ConfirmableElementInterface
{
    use AccessibilityLabelTrait;
    use ActionIdTrait;
    use ConfirmElementTrait;
    use StyleTrait;

    // @doc : https://api.slack.com/reference/block-kit/block-elements#button

    private const BUTTON_ELEMENT_TYPE = 'button';

    private const MAX_TEXT_LENGTH = 75;

    private const MAX_URL_LENGTH = 3000;

    private const MAX_VALUE_LENGTH = 2000;

    private const MAX_ACCESSIBILITY_LABEL_LENGTH = 75;

    private array $block = [
        'type' => self::BUTTON_ELEMENT_TYPE
    ];

    private ButtonTextObject $text;

    private ?string $url = null;

    private ?string $value = null;

    public function setText(ButtonTextObject $text): ButtonElement
    {
        $this->text = $text;

        return $this;
    }

    public function setUrl(?string $url): ButtonElement
    {
        $this->url = $url;

        return $this;
    }

    public function setValue(?string $value): ButtonElement
    {
        $this->value = $value;

        return $this;
    }

    private function validate(): void
    {
        if (strlen($this->text->getText()) > self::MAX_TEXT_LENGTH) {
            throw new TooLongTextException(strlen($this->text->getText()), self::MAX_TEXT_LENGTH, 'text');
        }

        if (!is_null($this->url) && strlen($this->url) > self::MAX_URL_LENGTH) {
            throw new TooLongTextException(strlen($this->url), self::MAX_URL_LENGTH, 'url');
        }

        if (!is_null($this->value) && strlen($this->value) > self::MAX_VALUE_LENGTH) {
            throw new TooLongTextException(strlen($this->value), self::MAX_VALUE_LENGTH, 'value');
        }

        $this->validateAccessibilityLabel(self::MAX_ACCESSIBILITY_LABEL_LENGTH);
    }

    private function handleUrl(): self
    {
        if (!is_null($this->url)) {
            $this->block['url'] = $this->url;
        }

        return $this;
    }

    private function handleValue(): self
    {
        if (!is_null($this->value)) {
            $this->block['value'] = $this->value;
        }

        return $this;
    }


    public function toArray(): array
    {
        $this->validate();

        $this
            ->handleStyle()
            ->handleActionId()
            ->handleUrl()
            ->handleValue()
            ->handleConfirm()
            ->handleAccessibilityLabel()
        ;

        $this->block['text'] = $this->text->toArray();

        return $this->block;
    }

    public function getCompatibleBlocks(): array
    {
        return [
            SectionBlock::class,
            ActionBlock::class
        ];
    }
}
