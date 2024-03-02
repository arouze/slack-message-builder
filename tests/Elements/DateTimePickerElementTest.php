<?php

namespace Arouze\Tests\Elements;

use Arouze\SlackMessageBuilder\Elements\DateTimePickerElement;
use Arouze\SlackMessageBuilder\Exceptions\IncorrectTimeStampException;
use Arouze\Tests\AbstractSlackMessageBuilderBaseTestCase;
use PHPUnit\Framework\Attributes\Group;

#[Group("DateTimePickerElement")]
#[Group("Elements")]
class DateTimePickerElementTest extends AbstractSlackMessageBuilderBaseTestCase
{
    public function testDateTimePickerElement(): void
    {
        self::assertEquals(
            [
                'type' => 'datetimepicker'
            ],
            (new DateTimePickerElement())
                ->toArray()
        );
    }

    public function testDateTimePickerElementWithInitialDateTime(): void
    {
        $initialDateTime = (new \DateTime())->getTimestamp();

        self::assertEquals(
            [
                'type' => 'datetimepicker',
                'initial_date_time' => $initialDateTime
            ],
            (new DateTimePickerElement())
                ->setInitialDateTime($initialDateTime)
                ->toArray()
        );
    }

    public function testDateTimePickerWithIncorrectTimeStampException(): void
    {
        self::expectException(IncorrectTimeStampException::class);

        $incorrectTimeStamp = $this->fakerGenerator->numberBetween(1, 10000);

        $dateTimePicker = (new DateTimePickerElement())
            ->setInitialDateTime($incorrectTimeStamp);

        $dateTimePicker->toArray();
    }
}
