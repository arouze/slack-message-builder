<?php

namespace Arouze\Tests\Blocks;

use Arouze\SlackMessageBuilder\Blocks\ActionBlock;
use Arouze\SlackMessageBuilder\Exceptions\TooMuchElementsException;
use Arouze\Tests\AbstractSlackMessageBuilderBaseTestCase;
use PHPUnit\Framework\Attributes\Group;

#[Group("ActionBlock")]
#[Group("Blocks")]
class ActionBlockTest extends AbstractSlackMessageBuilderBaseTestCase
{
    public function testSectionBlockWithAccessory(): void
    {
        self::assertEquals(
            [
                'type' => 'actions',
                'elements' => []
            ],
            (new ActionBlock())
                ->toArray()
        );
    }

    public function testTooMuchElementsException(): void
    {
        self::expectException(TooMuchElementsException::class);

        $actions = (new ActionBlock());

        for ($i = 0; $i < ActionBlock::MAX_ELEMENTS+1; $i++) {
            $actions->addElement(self::buildButtonElement());
        }

        $actions->toArray();
    }

}
