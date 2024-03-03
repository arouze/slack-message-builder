<?php

namespace Arouze\SlackMessageBuilder\Objects;

use Arouze\SlackMessageBuilder\Elements\OptionObjectTrait;
use Arouze\SlackMessageBuilder\Exceptions\TooLongTextException;

class OptionGroupObject implements ObjectInterface
{
    use OptionObjectTrait;

    // @doc : https://api.slack.com/reference/block-kit/composition-objects#option_group

    private const MAX_LABEL_LENGTH = 75;

    private const MAX_OPTIONS = 100;

    private TextObject $label;

    private array $block = [];


    public function setLabel(TextObject $label): self
    {
        $this->label = $label;

        return $this;
    }
    private function validate(): void
    {
        if (strlen($this->label->getText()) > self::MAX_LABEL_LENGTH) {
            throw new TooLongTextException(
                strlen($this->label->getText()),
                self::MAX_LABEL_LENGTH,
                'label'
            );
        }

        $this->validateMaxOptions(self::MAX_OPTIONS);
    }

    public function toArray(): array
    {
        $this->validate();

        $this->block['label'] = $this->label->toArray();

        $this->handleOptions();

        return $this->block;
    }
}
