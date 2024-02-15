<?php

namespace Arouze\SlackMessageBuilder\Elements;

use Arouze\SlackMessageBuilder\Objects\ButtonTextObject;

class ButtonElement implements ElementInterface
{
    public const BUTTON_STYLE_DEFAULT = 'default';
    public const BUTTON_STYLE_PRIMARY = 'primary';
    public const BUTTON_STYLE_DANGER = 'danger';
    private const BUTTON_ELEMENT_TYPE = 'button';

    private ButtonTextObject $buttonTextObject;

    private string $style = self::BUTTON_STYLE_DEFAULT;

    public function setButtonTextObject(ButtonTextObject $buttonTextObject): ButtonElement
    {
        $this->buttonTextObject = $buttonTextObject;

        return $this;
    }

    public function setStyle(string $style): ButtonElement
    {
        $this->style = $style;

        return $this;
    }

    public function toArray(): array
    {
        $block = [
            'type' => self::BUTTON_ELEMENT_TYPE,
            'text' => $this->buttonTextObject->toArray()
        ];

        if ($this->style !== self::BUTTON_STYLE_DEFAULT) {
            $block = array_merge(
                $block,
                [
                    'style' => $this->style
                ]
            );
        }

        return $block;
    }
}
