<?php

namespace Arouze\SlackMessageBuilder\Elements;

use Arouze\SlackMessageBuilder\Blocks\InputBlock;
use Arouze\SlackMessageBuilder\Common\ActionIdTrait;

class UrlInputElement implements BlockElementsInterface
{
    use ActionIdTrait;
    use InitialValueTrait;
    use DispatchActionConfigTrait;
    use FocusOnLoadTrait;
    use PlaceHolderTrait;

    // @doc : https://api.slack.com/reference/block-kit/block-elements#url

    private const URL_INPUT_TYPE = 'url_text_input';

    private const PLACEHOLDER_MAX_LENGTH = 150;

    private array $block = [
        'type' => self::URL_INPUT_TYPE
    ];

    private function validate(): void
    {
        $this->validatePlaceHolder(self::PLACEHOLDER_MAX_LENGTH);
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
