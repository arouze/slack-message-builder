<?php

namespace Arouze\SlackMessageBuilder\Elements;

use Arouze\SlackMessageBuilder\Objects\OptionObject;

trait InitialOptionsTrait
{
    private array $initialOptions = [];

    public function addInitialOptions(OptionObject $optionObject): self
    {
        $this->initialOptions[] = $optionObject;

        return $this;
    }

    private function handleInitialOptions(): self
    {
        /** @var OptionObject $initialOption */
        foreach ($this->initialOptions as $initialOption) {
            $this->block['initial_options'][] = $initialOption->toArray();
        }

        return $this;
    }
}
