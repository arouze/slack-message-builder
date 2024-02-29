<?php

namespace Arouze\SlackMessageBuilder\Elements;

class DateTimePickerElement implements ElementInterface
{
    private const DATETIME_PICKER_ELEMENT_TYPE = 'datetimepicker';

    public function toArray(): array
    {
        return [
            'type' => self::DATETIME_PICKER_ELEMENT_TYPE
        ];
    }
}
