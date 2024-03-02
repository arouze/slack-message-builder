<?php

namespace Arouze\SlackMessageBuilder\Elements;

use Arouze\SlackMessageBuilder\Blocks\ActionBlock;
use Arouze\SlackMessageBuilder\Blocks\InputBlock;
use Arouze\SlackMessageBuilder\Blocks\SectionBlock;
use Arouze\SlackMessageBuilder\Common\ActionIdInterface;
use Arouze\SlackMessageBuilder\Common\ActionIdTrait;
use Arouze\SlackMessageBuilder\Exceptions\TooMuchOptionsException;
use Arouze\SlackMessageBuilder\Objects\OptionObject;

class CheckBoxElement implements BlockElementsInterface, ActionIdInterface, ConfirmableElementInterface, FocusableInterface // phpcs:ignore
{
    use ActionIdTrait;
    use ConfirmElementTrait;
    use FocusOnLoadTrait;

    // @doc : https://api.slack.com/reference/block-kit/block-elements#checkboxes

    private const CHECKBOXES_TYPE = 'checkboxes';

    private const MAX_OPTIONS = 10;

    private array $block = [
        'type' => self::CHECKBOXES_TYPE
    ];

    private array $options = [];

    private array $initialOptions = [];

    public function addOption(OptionObject $optionObject): self
    {
        $this->options[] = $optionObject;

        return $this;
    }

    public function addInitialOptions(OptionObject $optionObject): self
    {
        $this->initialOptions[] = $optionObject;

        return $this;
    }

    private function handleOptions(): self
    {
        /** @var OptionObject $option */
        foreach ($this->options as $option) {
            $this->block['options'][] = $option->toArray();
        }

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

    private function validate(): void
    {
        if (count($this->options) > self::MAX_OPTIONS) {
            throw new TooMuchOptionsException(count($this->options), self::MAX_OPTIONS, self::class);
        }
    }

    public function toArray(): array
    {
        $this->validate();

        $this
            ->handleOptions()
            ->handleInitialOptions()
            ->handleConfirm()
            ->handleFocusOnLoad();

        return $this->block;
    }

    public function getCompatibleBlocks(): array
    {
        return [
            SectionBlock::class,
            ActionBlock::class,
            InputBlock::class
        ];
    }
}
