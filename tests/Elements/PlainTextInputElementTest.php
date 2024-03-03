<?php

namespace Arouze\Tests\Elements;

use Arouze\SlackMessageBuilder\Elements\PlainTextInputElement;
use Arouze\SlackMessageBuilder\Exceptions\IncorrectFieldLengthException;
use Arouze\Tests\AbstractSlackMessageBuilderBaseTestCase;
use PHPUnit\Framework\Attributes\Group;

#[Group("PlainTextInputElement")]
#[Group("Elements")]
class PlainTextInputElementTest extends AbstractSlackMessageBuilderBaseTestCase
{
    public function testPlainTextInput(): void
    {
        self::assertEquals(
            [
                'type' => 'plain_text_input'
            ],
            (new PlainTextInputElement())
                ->toArray()
        );
    }

    public function testPlainTextInputWithMultiline(): void
    {
        self::assertEquals(
            [
                'type' => 'plain_text_input',
                'multiline' => true
            ],
            (new PlainTextInputElement())
                ->enableMultiline()
                ->toArray()
        );
    }

    public function testPlainTextInputWithMinValue(): void
    {
        self::assertEquals(
            [
                'type' => 'plain_text_input',
                'min_length' => 10
            ],
            (new PlainTextInputElement())
                ->setMinLength(10)
                ->toArray()
        );
    }

    public function testPlainTextInputWithMaxValue(): void
    {
        self::assertEquals(
            [
                'type' => 'plain_text_input',
                'max_length' => 100
            ],
            (new PlainTextInputElement())
                ->setMaxLength(100)
                ->toArray()
        );
    }

    public function testPlainTextInputWithTooLongMaxValue(): void
    {
        self::expectException(IncorrectFieldLengthException::class);

        (new PlainTextInputElement())
            ->setMaxLength(3001)
            ->toArray();
    }

    public function testPlainTextInputWithTooShortMaxValue(): void
    {
        self::expectException(IncorrectFieldLengthException::class);

        (new PlainTextInputElement())
            ->setMaxLength(0)
            ->toArray();
    }

    public function testPlainTextInputWithTooLongMinValue(): void
    {
        self::expectException(IncorrectFieldLengthException::class);

        (new PlainTextInputElement())
            ->setMinLength(3001)
            ->toArray();
    }

    public function testPlainTextInputWithTooShortMinValue(): void
    {
        self::expectException(IncorrectFieldLengthException::class);

        (new PlainTextInputElement())
            ->setMinLength(-1)
            ->toArray();
    }
}
