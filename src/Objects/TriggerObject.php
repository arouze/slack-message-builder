<?php

namespace Arouze\SlackMessageBuilder\Objects;

class TriggerObject implements ObjectInterface
{
    // @doc : https://api.slack.com/reference/block-kit/composition-objects#trigger

    private array $block = [];

    private string $url;

    private array $customizableInputParameters = [];

    public function setUrl(string $url): TriggerObject
    {
        $this->url = $url;

        return $this;
    }

    public function addCustomizableInputParameters(ObjectInterface $compositionObject): self
    {
        $this->customizableInputParameters[] = $compositionObject;
        return $this;
    }

    private function handleCustomizableInputParameters(): self
    {
        /** @var ObjectInterface $customizableInputParameter */
        foreach ($this->customizableInputParameters as $customizableInputParameter) {
            $this->block['customizable_input_parameters'][] = $customizableInputParameter->toArray();
        }

        return $this;
    }

    public function toArray(): array
    {
        $this->handleCustomizableInputParameters();

        $this->block['url'] = $this->url;

        return $this->block;
    }
}
