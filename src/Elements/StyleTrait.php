<?php

namespace Arouze\SlackMessageBuilder\Elements;

trait StyleTrait
{
    public const BUTTON_STYLE_DEFAULT = 'default';
    public const BUTTON_STYLE_PRIMARY = 'primary';
    public const BUTTON_STYLE_DANGER = 'danger';
    private string $style = self::BUTTON_STYLE_DEFAULT;

    public function setStyle(string $style): self
    {
        $this->style = $style;

        return $this;
    }

    private function handleStyle(): self
    {
        if ($this->style !== self::BUTTON_STYLE_DEFAULT) {
            $this->block['style'] = $this->style;
        }

        return $this;
    }
}
