<?php

namespace Arouze\SlackMessageBuilder\Elements;

trait InitialValueTrait
{
    private ?string $initialValue = null;

    public function setInitialValue(?string $initialValue): self
    {
        $this->initialValue = $initialValue;

        return $this;
    }

    private function handleInitialValue(): self
    {
        if (!is_null($this->initialValue)) {
            $this->block['initial_value'] = $this->initialValue;
        }

        return $this;
    }
}
