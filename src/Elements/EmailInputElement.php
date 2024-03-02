<?php

namespace Arouze\SlackMessageBuilder\Elements;

use Arouze\SlackMessageBuilder\Blocks\InputBlock;
use Arouze\SlackMessageBuilder\Common\ActionIdInterface;
use Arouze\SlackMessageBuilder\Common\ActionIdTrait;
use Arouze\SlackMessageBuilder\Exceptions\TooLongTextException;
use Arouze\Tests\Objects\DispatchActionConfigurationObject;

class EmailInputElement implements BlockElementsInterface, ActionIdInterface, FocusableInterface
{
    use ActionIdTrait;
    use FocusOnLoadTrait;
    use PlaceHolderTrait;

    // @doc : https://api.slack.com/reference/block-kit/block-elements#email
    private const EMAIL_INPUT_ELEMENT_TYPE = 'email_text_input';

    private const MAX_PLACEHOLDER_LENGTH = 150;

    private array $block = [
        'type' => self::EMAIL_INPUT_ELEMENT_TYPE
    ];

    private ?DispatchActionConfigurationObject $dispatchActionConfig = null;

    private ?string $initialValue = null;

    public function setInitialValue(?string $initialValue): self
    {
        $this->initialValue = $initialValue;

        return $this;
    }

    public function setDispatchActionConfig(?DispatchActionConfigurationObject $dispatchActionConfig): self
    {
        $this->dispatchActionConfig = $dispatchActionConfig;

        return $this;
    }

    private function handleInitialValue(): self
    {
        if (!is_null($this->initialValue)) {
            $this->block['initial_value'] = $this->initialValue;
        }

        return $this;
    }

    private function handleDispatchActionConfig(): self
    {
        if (!is_null($this->dispatchActionConfig)) {
            $this->block['dispatch_action_config'] = $this->dispatchActionConfig->toArray();
        }

        return $this;
    }
    private function validate(): void
    {
        if (!is_null($this->placeholder) && strlen($this->placeholder->getText()) > self::MAX_PLACEHOLDER_LENGTH) {
            throw new TooLongTextException(strlen($this->placeholder->getText()), self::MAX_PLACEHOLDER_LENGTH);
        }
    }

    public function toArray(): array
    {
        $this->validate();

        $this
            ->handleActionId()
            ->handleInitialValue()
            ->handleDispatchActionConfig()
            ->handleFocusOnLoad()
            ->handlePlaceHolder()
        ;

        return $this->block;
    }

    public function getCompatibleBlocks(): array
    {
        return [
            InputBlock::class
        ];
    }
}
