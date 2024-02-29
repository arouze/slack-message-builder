<?php

namespace Arouze\Tests\Blocks;

use Arouze\SlackMessageBuilder\Blocks\InputBlock;
use Arouze\SlackMessageBuilder\Exceptions\TooLongTextException;
use Arouze\Tests\AbstractSlackMessageBuilderBaseTestCase;
use PHPUnit\Framework\Attributes\Group;

#[Group("InputBlock")]
#[Group("Blocks")]
class InputBlockTest extends AbstractSlackMessageBuilderBaseTestCase
{
    public function testInput(): void
    {
        $labelObject = self::buildTextObject();
        $elementObject = self::buildButtonElement();

        self::assertEquals(
            [
                'type' => 'input',
                'label' => $labelObject->toArray(),
                'element' => $elementObject->toArray(),
                'dispatch_action' => false,
                'optional' => false
            ],
            (new InputBlock())
            ->setLabel($labelObject)
            ->setElement($elementObject)
            ->toArray()
        );
    }

    public function testTooLabelTextException(): void
    {
        self::expectException(TooLongTextException::class);

        (new InputBlock())
            ->setLabel(
                self::buildTextObject()
                    ->setText(
                        $this->fakerGenerator->realTextBetween(2001, 3000)
                    )
            )
            ->toArray();
    }

    public function testTooHintTextException(): void
    {
        self::expectException(TooLongTextException::class);

        (new InputBlock())
            ->setLabel(
                self::buildTextObject()
            )
            ->setElement(
                self::buildButtonElement()
            )
            ->setHint(
                self::buildTextObject()
                    ->setText(
                        $this->fakerGenerator->realTextBetween(2001, 3000)
                    )
            )
            ->toArray();
    }
}
