<?php

namespace Arouze\Tests\Blocks;

use Arouze\SlackMessageBuilder\Blocks\SectionBlock;
use Arouze\SlackMessageBuilder\Exceptions\MissingFieldException;
use Arouze\SlackMessageBuilder\Exceptions\TooMuchElementsException;
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

    public function testSectionBlockWithFields(): void
    {
        self::assertEquals(
            [
                'type' => 'section',
                'fields' => [
                    [
                        'type' => 'plain_text',
                        'text' => 'Banana'
                    ],
                    [
                        'type' => 'plain_text',
                        'text' => 'Apple'
                    ],
                    [
                        'type' => 'plain_text',
                        'text' => 'Kiwi'
                    ]
                ]
            ],
            (new SectionBlock())
                ->addFields(self::buildTextObject()->setText('Banana'))
                ->addFields(self::buildTextObject()->setText('Apple'))
                ->addFields(self::buildTextObject()->setText('Kiwi'))
                ->toArray()
        );
    }

    public function testSectionBlockWithBlockId(): void
    {
        self::assertEquals(
            [
                'type' => 'section',
                'text' => [
                    'type' => 'plain_text',
                    'text' => 'Simple text.'
                ],
                'block_id' => 'block_id_1'
            ],
            (new SectionBlock())
                ->setTextObject(self::buildTextObject())
                ->setBlockId('block_id_1')
                ->toArray()
        );
    }

    public function testSectionBlockWithoutFieldsAndText(): void
    {
        self::expectException(MissingFieldException::class);

        (new SectionBlock())
            ->setBlockId('block_id_1')
            ->toArray();
    }
}
