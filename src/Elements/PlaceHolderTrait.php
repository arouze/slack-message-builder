<?php

namespace Arouze\SlackMessageBuilder\Elements;

use Arouze\SlackMessageBuilder\Objects\TextObject;

trait PlaceHolderTrait
{
    private ?TextObject $placeholder = null;

    public function setPlaceholder(?TextObject $placeholder): self
    {
        $this->placeholder = $placeholder;

        return $this;
    }

    private function handlePlaceHolder(): self
    {
        if (!is_null($this->placeholder)) {
            $this->block['placeholder'] = $this->placeholder->toArray();
        }

        return $this;
    }
}
