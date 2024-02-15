<?php

namespace Arouze\Tests\Blocks;

use Arouze\SlackMessageBuilder\Blocks\SectionBlock;
use Arouze\Tests\AbstractSlackMessageBuilderBaseTestCase;
use PHPUnit\Framework\Attributes\Group;

#[Group("SectionBlock")]
#[Group("Blocks")]
class SectionBlockTest extends AbstractSlackMessageBuilderBaseTestCase
{
    public function testSectionBlockWithAccessory(): void
    {
        self::assertEquals(
            [
                'type' => 'section',
                'text' => [
                    'type' => 'plain_text',
                    'text' => 'Simple text.'
                ],
                'accessory' => [
                    'type' => 'image',
                    'image_url' => 'https://s3-media3.fl.yelpcdn.com/bphoto/c7ed05m9lC2EmA3Aruue7A/o.jpg',
                    'alt_text' => 'Alt text'
                ]
            ],
            (new SectionBlock())
                ->setTextObject(self::buildTextObject())
                ->setAccessory(self::buildImageAccessory())
                ->toArray()
        );
    }
}
