<?php

namespace Arouze\Tests\Elements;


use Arouze\SlackMessageBuilder\Elements\MultiSelectMenuElement;
use Arouze\SlackMessageBuilder\Exceptions\IncorrectOptionsConfigurationException;
use Arouze\SlackMessageBuilder\Exceptions\TooMuchOptionGroupsException;
use Arouze\SlackMessageBuilder\Exceptions\TooMuchOptionsException;
use Arouze\Tests\AbstractSlackMessageBuilderBaseTestCase;
use PHPUnit\Framework\Attributes\Group;

#[Group("MultiSelectMenuElement")]
#[Group("Elements")]
class MultiSelectMenuElementTest extends AbstractSlackMessageBuilderBaseTestCase
{
    public function testMultiSelectMenu(): void
    {
        $optionObject = self::buildOptionObject();
        self::assertEquals(
            [
                'type' => 'multi_static_select',
                'options' => [
                    $optionObject->toArray()
                ]
            ],
            (new MultiSelectMenuElement())
            ->addOption($optionObject)
            ->toArray()
        );
    }

    public function testMultiSelectMenuWithInitialOptions(): void
    {
        $optionObject1 = self::buildOptionObject();
        $optionObject2 = self::buildOptionObject();
        $optionObject3 = self::buildOptionObject();
        self::assertEquals(
            [
                'type' => 'multi_static_select',
                'options' => [
                    $optionObject1->toArray(),
                    $optionObject2->toArray(),
                    $optionObject3->toArray()
                ],
                'initial_options' => [
                    $optionObject2->toArray()
                ]
            ],
            (new MultiSelectMenuElement())
                ->addOption($optionObject1)
                ->addOption($optionObject2)
                ->addOption($optionObject3)
                ->addInitialOptions($optionObject2)
                ->toArray()
        );
    }

    public function testMultiSelectMenuWithMaxSelectedItems(): void
    {
        $optionObject = self::buildOptionObject();
        self::assertEquals(
            [
                'type' => 'multi_static_select',
                'options' => [
                    $optionObject->toArray()
                ],
                'max_selected_items' => 10
            ],
            (new MultiSelectMenuElement())
                ->addOption($optionObject)
                ->setMaxSelectedItems(10)
                ->toArray()
        );
    }

    public function testMultiSelectMenuWithTooMuchOptionsGroupsException(): void
    {
        self::expectException(TooMuchOptionGroupsException::class);

        $multiSelectMenu = (new MultiSelectMenuElement());

        for ($i = 0; $i < 101; $i++) {
            $multiSelectMenu->addOptionGroup(self::buildOptionGroupObject());
        }

        $multiSelectMenu->toArray();
    }

    public function testMultiSelectMenuWithTooMuchOptionsException(): void
    {
        self::expectException(TooMuchOptionsException::class);

        $multiSelectMenu = (new MultiSelectMenuElement());

        for ($i = 0; $i < 101; $i++) {
            $multiSelectMenu->addOption(self::buildOptionObject());
        }

        $multiSelectMenu->toArray();
    }

    public function testMultiSelectMenuWithOptionsAndOptionsGroupException(): void
    {
        self::expectException(IncorrectOptionsConfigurationException::class);

        (new MultiSelectMenuElement())
            ->addOption(self::buildOptionObject())
            ->addOptionGroup(self::buildOptionGroupObject())
            ->toArray();
    }
}
