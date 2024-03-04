<?php

namespace Arouze\SlackMessageBuilder\Elements;

use Arouze\SlackMessageBuilder\Blocks\InputBlock;
use Arouze\SlackMessageBuilder\Common\ActionIdInterface;
use Arouze\SlackMessageBuilder\Common\ActionIdTrait;

class EmailInputElement implements BlockElementsInterface, ActionIdInterface, FocusableInterface
{
    use ActionIdTrait;
    use DispatchActionConfigTrait;
    use FocusOnLoadTrait;
    use InitialValueTrait;
    use PlaceHolderTrait;

    // @doc : https://api.slack.com/reference/block-kit/block-elements#email
    private const EMAIL_INPUT_ELEMENT_TYPE = 'email_text_input';

    private const MAX_PLACEHOLDER_LENGTH = 150;

    private array $block = [
        'type' => self::EMAIL_INPUT_ELEMENT_TYPE
    ];

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
