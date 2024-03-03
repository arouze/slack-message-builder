<?php

namespace Arouze\Tests\Objects;

use Arouze\SlackMessageBuilder\Exceptions\TooLongTextException;
use Arouze\SlackMessageBuilder\Exceptions\TooMuchOptionsException;
use Arouze\SlackMessageBuilder\Objects\OptionGroupObject;
use Arouze\Tests\AbstractSlackMessageBuilderBaseTestCase;
use PHPUnit\Framework\Attributes\Group;

#[Group("OptionGroupObject")]
#[Group("Elements")]
class OptionGroupObjectTest extends AbstractSlackMessageBuilderBaseTestCase
{
    public function testOptionGroupObject(): void
    {
        $option = self::buildOptionObject();
        $label = self::buildTextObject();

        self::assertEquals(
            [
                'label' => $label->toArray(),
                'options' => [
                    $option->toArray()
                ]
            ],
            (new OptionGroupObject())
                ->setLabel($label)
                ->addOption($option)
                ->toArray()
        );
    }

    public function testOptionGroupObjectWithTooLongLabelTextException(): void
    {
        self::expectException(TooLongTextException::class);

        $optionGroup = (new OptionGroupObject())
            ->addOption(self::buildOptionObject())
            ->setLabel(
                self::buildTextObject()->setText(
                    $this->fakerGenerator->realTextBetween(76)
                )
            );

        $optionGroup->toArray();
    }

    public function testOptionGroupObjectWithTooMuchOptionsException(): void
    {
        self::expectException(TooMuchOptionsException::class);

        $optionGroup = (new OptionGroupObject())
            ->setLabel(self::buildTextObject());

        for ($i = 0; $i < 101; $i++) {
            $optionGroup->addOption(self::buildOptionObject());
        }

        $optionGroup->toArray();
    }
}
