<?php

namespace Arouze\SlackMessageBuilder\Elements;

use Arouze\SlackMessageBuilder\Blocks\ActionBlock;
use Arouze\SlackMessageBuilder\Blocks\InputBlock;

class DateTimePickerElement implements BlockElementsInterface
{
    private const DATETIME_PICKER_ELEMENT_TYPE = 'datetimepicker';

    public function toArray(): array
    {
        return [
            'type' => self::DATETIME_PICKER_ELEMENT_TYPE
        ];
    }

    public function getCompatibleBlocks(): array
    {
        return [
            ActionBlock::class,
            InputBlock::class
        ];
    }
}
