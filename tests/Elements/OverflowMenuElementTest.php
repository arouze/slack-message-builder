<?php

namespace Arouze\Tests\Elements;

use Arouze\SlackMessageBuilder\Elements\OverflowMenuElement;
use Arouze\SlackMessageBuilder\Exceptions\TooMuchOptionsException;
use Arouze\Tests\AbstractSlackMessageBuilderBaseTestCase;
use PHPUnit\Framework\Attributes\Group;

#[Group("OverflowMenu")]
#[Group("Elements")]
class OverflowMenuElementTest extends AbstractSlackMessageBuilderBaseTestCase
{
    public function testOverflowMenu(): void
    {
        $option = self::buildOptionObject();
        self::assertEquals(
            [
                'type' => 'overflow',
                'options' => [
                    $option->toArray()
                ]
            ],
            (new OverflowMenuElement())
                ->addOption($option)
                ->toArray()
        );
    }

    public function testOverflowMenuMaxOptionsException(): void
    {
        self::expectException(TooMuchOptionsException::class);

        (new OverflowMenuElement())
            ->addOption(self::buildOptionObject())
            ->addOption(self::buildOptionObject())
            ->addOption(self::buildOptionObject())
            ->addOption(self::buildOptionObject())
            ->addOption(self::buildOptionObject())
            ->addOption(self::buildOptionObject())
            ->toArray();
    }
}
