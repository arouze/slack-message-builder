<?php

namespace Arouze\SlackMessageBuilder\Elements;

use Arouze\SlackMessageBuilder\Exceptions\TooMuchOptionsException;
use Arouze\SlackMessageBuilder\Objects\OptionObject;

trait OptionObjectTrait
{
    private array $options = [];

    public function addOption(OptionObject $optionObject): self
    {
        $this->options[] = $optionObject;

        return $this;
    }

    private function handleOptions(): self
    {
        if (count($this->options)) {
            $this->block['options'] = [];
        }

        /** @var OptionObject $option */
        foreach ($this->options as $option) {
            $this->block['options'][] = $option->toArray();
        }

        return $this;
    }

    private function validateMaxOptions(int $maxOptions): void
    {
        if (count($this->options) > $maxOptions) {
            throw new TooMuchOptionsException(
                count($this->options),
                $maxOptions,
                self::class
            );
        }
    }
}
