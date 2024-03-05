<?php

namespace Arouze\SlackMessageBuilder\Elements\RichText;

trait RichTestBorderTrait
{
    private ?int $border = null;
    public function setBorder(?int $border): self
    {
        $this->border = $border;

        return $this;
    }

    private function handleBorder(): self
    {
        if (!is_null($this->border)) {
            $this->block['border'] = $this->border;
        }

        return $this;
    }
}
