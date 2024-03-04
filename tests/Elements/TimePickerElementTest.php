<?php

namespace Arouze\Tests\Elements;

use Arouze\SlackMessageBuilder\Elements\TimePickerElement;
use Arouze\Tests\AbstractSlackMessageBuilderBaseTestCase;
use PHPUnit\Framework\Attributes\Group;

#[Group("TimePickerElement")]
#[Group("Elements")]
class TimePickerElementTest extends AbstractSlackMessageBuilderBaseTestCase
{
    public function testTimePickerElement(): void
    {
        self::assertEquals(
            [
                'type' => 'timepicker'
            ],
            (new TimePickerElement())
                ->toArray()
        );
    }

    public function testTimePickerElementWithInitialTime(): void
    {
        self::assertEquals(
            [
                'type' => 'timepicker',
                'initial_time' => '13:37'
            ],
            (new TimePickerElement())
                ->setInitialTime('13:37')
                ->toArray()
        );
    }

    public function testTimePickerElementWithTimezone(): void
    {
        self::assertEquals(
            [
                'type' => 'timepicker',
                'timezone' => 'Europe/Paris'
            ],
            (new TimePickerElement())
                ->setTimeZone('Europe/Paris')
                ->toArray()
        );
    }
}
