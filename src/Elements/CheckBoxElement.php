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
    use InitialOptionsTrait;
    use OptionObjectTrait;

    // @doc : https://api.slack.com/reference/block-kit/block-elements#checkboxes

    private const CHECKBOXES_TYPE = 'checkboxes';

    private const MAX_OPTIONS = 10;

    private array $block = [
        'type' => self::CHECKBOXES_TYPE
    ];

    private function validate(): void
    {
        $this->validateMaxOptions(self::MAX_OPTIONS);
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
