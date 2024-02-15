<?php

namespace Arouze\Tests\Blocks;

use Arouze\SlackMessageBuilder\Blocks\DividerBlock;
use Arouze\Tests\AbstractSlackMessageBuilderBaseTestCase;
use PHPUnit\Framework\Attributes\Group;

#[Group("DividerBlock")]
#[Group("Blocks")]
class DividerBlockTest extends AbstractSlackMessageBuilderBaseTestCase
{
    public function testDivider(): void
    {
        self::assertEquals(
            [
                'type' => 'divider'
            ],
            (new DividerBlock())->toArray()
        );
    }
}
