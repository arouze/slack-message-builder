<?php

namespace Arouze\Tests\Elements;

use Arouze\SlackMessageBuilder\Elements\NumberInputElement;
use Arouze\SlackMessageBuilder\Exceptions\IncorrectMinMaxValueException;
use Arouze\Tests\AbstractSlackMessageBuilderBaseTestCase;
use PHPUnit\Framework\Attributes\Group;

#[Group("NumberInput")]
#[Group("Elements")]
class NumberInputElementTest extends AbstractSlackMessageBuilderBaseTestCase
{
    public function testNumberInputElement(): void
    {
        self::assertEquals(
            [
                'type' => 'number_input',
                'is_decimal_allowed' => false
            ],
            (new NumberInputElement())
                ->toArray()
        );
    }

    public function testNumberInputElementWithDecimalEnabled(): void
    {
        self::assertEquals(
            [
                'type' => 'number_input',
                'is_decimal_allowed' => true
            ],
            (new NumberInputElement())
                ->enableDecimal()
                ->toArray()
        );
    }

    public function testNumberInputElementWithInitialValue(): void
    {
        self::assertEquals(
            [
                'type' => 'number_input',
                'is_decimal_allowed' => false,
                'initial_value' => '100'
            ],
            (new NumberInputElement())
                ->setInitialValue('100')
                ->toArray()
        );
    }

    public function testNumberInputElementWithMinValue(): void
    {
        self::assertEquals(
            [
                'type' => 'number_input',
                'is_decimal_allowed' => false,
                'min_value' => '1'
            ],
            (new NumberInputElement())
                ->setMinValue('1')
                ->toArray()
        );
    }

    public function testNumberInputElementWithMaxValue(): void
    {
        self::assertEquals(
            [
                'type' => 'number_input',
                'is_decimal_allowed' => false,
                'max_value' => '100'
            ],
            (new NumberInputElement())
                ->setMaxValue('100')
                ->toArray()
        );
    }

    public function testNumberInputIncorrectMaxMinValue(): void
    {
        self::expectException(IncorrectMinMaxValueException::class);

        (new NumberInputElement())
            ->setMaxValue('1')
            ->setMinValue('10')
            ->toArray();
    }
}
