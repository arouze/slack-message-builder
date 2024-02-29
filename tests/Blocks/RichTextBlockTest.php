<?php

namespace Arouze\Tests\Blocks;

use Arouze\SlackMessageBuilder\Blocks\RichTextBlock;
use Arouze\Tests\AbstractSlackMessageBuilderBaseTestCase;
use PHPUnit\Framework\Attributes\Group;

#[Group("RichTextBlock")]
#[Group("RichText")]
#[Group("Blocks")]
class RichTextBlockTest extends AbstractSlackMessageBuilderBaseTestCase
{
    public function testRichTextBlock(): void
    {
        self::assertEquals(
            [
                'type' => 'rich_text',
                'elements' => []
            ],
            (new RichTextBlock())->toArray()
        );
    }
}
