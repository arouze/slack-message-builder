<?php

namespace Arouze\Tests\Elements;

use Arouze\SlackMessageBuilder\Elements\DatePickerElement;
use Arouze\SlackMessageBuilder\Exceptions\TooLongTextException;
use Arouze\Tests\AbstractSlackMessageBuilderBaseTestCase;
use PHPUnit\Framework\Attributes\Group;

#[Group("DatePickerElement")]
#[Group("Elements")]
class DatePickerElementTest extends AbstractSlackMessageBuilderBaseTestCase
{
    public function testDatePickerElement(): void
    {
        self::assertEquals(
            [
                'type' => 'datepicker'
            ],
            (new DatePickerElement())
                ->toArray()
        );
    }

    public function testDatePickerElementWithInitialDate(): void
    {
        $initialDate = $this->fakerGenerator->date();
        self::assertEquals(
            [
                'type' => 'datepicker',
                'initial_date' => $initialDate
            ],
            (new DatePickerElement())
                ->setInitialDate($initialDate)
                ->toArray()
        );
    }

    public function testDatePickerElementWithPlaceholder(): void
    {
        $placeholder = self::buildTextObject();
        $placeholder->setText($this->fakerGenerator->text(150));

        self::assertEquals(
            [
                'type' => 'datepicker',
                'placeholder' => $placeholder->toArray()
            ],
            (new DatePickerElement())
                ->setPlaceholder($placeholder)
                ->toArray()
        );
    }

    public function testDatePickerWithTooLongPlaceholderException(): void
    {
        self::expectException(TooLongTextException::class);

        $placeholder = self::buildTextObject();
        $placeholder->setText($this->fakerGenerator->realTextBetween(151));

        $datepicker = (new DatePickerElement())
            ->setPlaceholder($placeholder);

        $datepicker->toArray();
    }
}
