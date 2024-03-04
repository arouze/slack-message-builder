<?php

namespace Arouze\SlackMessageBuilder\Elements;

use Arouze\SlackMessageBuilder\Blocks\InputBlock;
use Arouze\SlackMessageBuilder\Common\ActionIdInterface;
use Arouze\SlackMessageBuilder\Common\ActionIdTrait;
use Arouze\SlackMessageBuilder\Elements\RichText\RichTextElementInterface;

class RichTextInputElement implements BlockElementsInterface, ActionIdInterface
{
    use ActionIdTrait;
    use DispatchActionConfigTrait;
    use FocusOnLoadTrait;
    use PlaceHolderTrait;

    // @doc : https://api.slack.com/reference/block-kit/block-elements#rich_text_input

    private const RICH_TEXT_INPUT_TYPE = 'rich_text_input';

    private const MAX_PLACEHOLDER_LENGTH = 150;

    private array $block = [
        'type' => self::RICH_TEXT_INPUT_TYPE
    ];

    private ?RichTextElementInterface $initialValue = null;

    public function setInitialValue(?RichTextElementInterface $initialValue): self
    {
        $this->initialValue = $initialValue;

        return $this;
    }

    private function handleInitialValue(): self
    {
        if (!is_null($this->initialValue)) {
            $this->block['initial_value'] = $this->initialValue->toArray();
        }

        return $this;
    }

    private function validate(): void
    {
        $this->validatePlaceHolder(self::MAX_PLACEHOLDER_LENGTH);
    }

    public function toArray(): array
    {
        $this->validate();

        $this
            ->handleActionId()
            ->handleInitialValue()
            ->handleDispatchActionConfig()
            ->handleFocusOnLoad()
            ->handlePlaceHolder();

        return $this->block;
    }

    public function getCompatibleBlocks(): array
    {
        return [
            InputBlock::class
        ];
    }
}
