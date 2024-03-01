<?php

namespace Arouze\Tests\Elements;

use Arouze\SlackMessageBuilder\Elements\CheckBoxElement;
use Arouze\SlackMessageBuilder\Exceptions\TooMuchOptionsException;
use Arouze\Tests\AbstractSlackMessageBuilderBaseTestCase;
use PHPUnit\Framework\Attributes\Group;

#[Group("CheckBoxElement")]
#[Group("Elements")]
class CheckBoxElementTest extends AbstractSlackMessageBuilderBaseTestCase
{
    public function testCheckBoxElement(): void
    {
        $option = self::buildOptionObject();
        self::assertEquals(
            [
                'type' => 'checkboxes',
                'options' => [
                    $option->toArray()
                ]
            ],
            (new CheckBoxElement())
                ->addOption($option)
                ->toArray()
        );
    }

    public function testCheckBoxElementWithInitialOptions(): void
    {
        $option1 = self::buildOptionObject();
        $option2 = self::buildOptionObject();
        $option3 = self::buildOptionObject();

        self::assertEquals(
            [
                'type' => 'checkboxes',
                'options' => [
                    $option1->toArray(),
                    $option2->toArray(),
                    $option3->toArray()
                ],
                'initial_options' => [
                    $option2->toArray()
                ]
            ],
            (new CheckBoxElement())
                ->addOption($option1)
                ->addOption($option2)
                ->addOption($option3)
                ->addInitialOptions($option2)
                ->toArray()
        );
    }

    public function testCheckBoxElementWithConfirmObject(): void
    {
        $option = self::buildOptionObject();
        $confirm = self::buildConfirmDialogObjectElement();

        self::assertEquals(
            [
                'type' => 'checkboxes',
                'options' => [
                    $option->toArray()
                ],
                'confirm' => $confirm->toArray()
            ],
            (new CheckBoxElement())
                ->addOption($option)
                ->setConfirm($confirm)
                ->toArray()
        );
    }

    public function testCheckBoxElementWithFocusOnLoad(): void
    {
        $option = self::buildOptionObject();
        self::assertEquals(
            [
                'type' => 'checkboxes',
                'options' => [
                    $option->toArray()
                ],
                'focus_on_load' => true
            ],
            (new CheckBoxElement())
                ->addOption($option)
                ->focusOnLoad()
                ->toArray()
        );
    }

    public function testCheckBoxWithTooMuchOptionsException(): void
    {
        self::expectException(TooMuchOptionsException::class);

        $checkbox = (new CheckBoxElement());

        for ($i = 0; $i < 11; $i++) {
            $checkbox->addOption(self::buildOptionObject());
        }

        $checkbox->toArray();
    }
}
