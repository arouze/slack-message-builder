<?php

namespace Arouze\Tests\Elements;

use Arouze\SlackMessageBuilder\Elements\SelectMenuElement;
use Arouze\SlackMessageBuilder\Exceptions\IncorrectOptionsConfigurationException;
use Arouze\SlackMessageBuilder\Exceptions\TooMuchOptionGroupsException;
use Arouze\SlackMessageBuilder\Exceptions\TooMuchOptionsException;
use Arouze\Tests\AbstractSlackMessageBuilderBaseTestCase;
use PHPUnit\Framework\Attributes\Group;

#[Group("SelectMenuElement")]
#[Group("Elements")]
class SelectMenuElementTest extends AbstractSlackMessageBuilderBaseTestCase
{
    public function testSelectMenuElement(): void
    {
        $option = self::buildOptionObject();
        self::assertEquals(
            [
                'type' => 'static_select',
                'options' => [
                    $option->toArray()
                ]
            ],
            (new SelectMenuElement())
                ->addOption($option)
                ->toArray()
        );
    }

    public function testSelectMenuElementWithOptionGroup(): void
    {
        $optionGroup = self::buildOptionGroupObject(self::buildOptionObject());

        self::assertEquals(
            [
                'type' => 'static_select',
                'option_groups' => [
                    $optionGroup->toArray()
                ]
            ],
            (new SelectMenuElement())
                ->addOptionGroup($optionGroup)
                ->toArray()
        );

    }

    public function testSelectMenuElementWithTooMuchOptionsException(): void
    {
        self::expectException(TooMuchOptionsException::class);

        $selectMenuElement = (new SelectMenuElement());

        for ($i = 0; $i < 101; $i++) {
            $selectMenuElement->addOption(self::buildOptionObject());
        }

        $selectMenuElement->toArray();
    }

    public function testSelectMenuWithTooMuchOptionsGroupsException(): void
    {
        self::expectException(TooMuchOptionGroupsException::class);

        $multiSelectMenu = (new SelectMenuElement());

        for ($i = 0; $i < 101; $i++) {
            $multiSelectMenu->addOptionGroup(self::buildOptionGroupObject());
        }

        $multiSelectMenu->toArray();
    }

    public function testSelectMenuWithTooMuchOptionsException(): void
    {
        self::expectException(TooMuchOptionsException::class);

        $multiSelectMenu = (new SelectMenuElement());

        for ($i = 0; $i < 101; $i++) {
            $multiSelectMenu->addOption(self::buildOptionObject());
        }

        $multiSelectMenu->toArray();
    }

    public function testSelectMenuWithOptionsAndOptionsGroupException(): void
    {
        self::expectException(IncorrectOptionsConfigurationException::class);

        (new SelectMenuElement())
            ->addOption(self::buildOptionObject())
            ->addOptionGroup(self::buildOptionGroupObject())
            ->toArray();
    }
}
