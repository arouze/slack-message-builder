<?php

namespace Arouze\Tests\Objects\RichText;

use Arouze\SlackMessageBuilder\Objects\RichText\EmojiType;
use Arouze\Tests\AbstractSlackMessageBuilderBaseTestCase;
use PHPUnit\Framework\Attributes\Group;

#[Group("EmojiType")]
#[Group("RichText")]
#[Group("Objects")]
class EmojiTypeTest extends AbstractSlackMessageBuilderBaseTestCase
{
    public function testEmojiType(): void
    {
        self::assertEquals(
            [
                'type' => 'emoji',
                'name' => 'wave'
            ],
            (new EmojiType())
                ->setName('wave')
                ->toArray()
        );
    }
}
