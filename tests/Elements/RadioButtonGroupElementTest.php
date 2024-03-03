<?php

namespace Arouze\Tests\Elements;

use Arouze\SlackMessageBuilder\Elements\RadioButtonGroupElement;
use Arouze\SlackMessageBuilder\Exceptions\TooMuchOptionsException;
use Arouze\Tests\AbstractSlackMessageBuilderBaseTestCase;
use PHPUnit\Framework\Attributes\Group;

#[Group("RadioButtonGroupElement")]
#[Group("Elements")]
class RadioButtonGroupElementTest extends AbstractSlackMessageBuilderBaseTestCase
{
    public function testRadioButtonGroup(): void
    {
        $option = self::buildOptionObject();
        self::assertEquals(
            [
                'type' => 'radio_buttons',
                'options' => [
                    $option->toArray()
                ]
            ],
            (new RadioButtonGroupElement())
                ->addOption($option)
                ->toArray()
        );
    }

    public function testRadioButtonGroupTooMushOptionsException(): void
    {
        self::expectException(TooMuchOptionsException::class);

        $radioButtonGroup = (new RadioButtonGroupElement());

        for ($i = 0; $i < 11; $i++) {
            $radioButtonGroup->addOption(self::buildOptionObject());
        }

        $radioButtonGroup->toArray();
    }
}
