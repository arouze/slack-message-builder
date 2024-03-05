<?php

namespace Arouze\Tests\Elements\RichText;

use Arouze\SlackMessageBuilder\Elements\RichText\RichTextPreformattedElement;
use Arouze\SlackMessageBuilder\Objects\RichText\EmojiType;
use Arouze\Tests\AbstractSlackMessageBuilderBaseTestCase;
use PHPUnit\Framework\Attributes\Group;

#[Group("RichTextPreformattedElement")]
#[Group("RichText")]
#[Group("Elements")]
class RichTextPreformattedElementTest extends AbstractSlackMessageBuilderBaseTestCase
{
    public function testRichTextPreformattedElement(): void
    {
        self::assertEquals(
            [
                'type' => 'rich_text_preformatted',
                'elements' => [
                    [
                        'type' => 'emoji',
                        'name' => 'wave'
                    ]
                ]
            ],
            (new RichTextPreformattedElement())
                ->addElement(
                    (new EmojiType())
                        ->setName('wave')
                )
                ->toArray()
        );
    }

    public function testRichTextPreformattedElementWithBorder(): void
    {
        self::assertEquals(
            [
                'type' => 'rich_text_preformatted',
                'elements' => [
                    [
                        'type' => 'emoji',
                        'name' => 'wave'
                    ]
                ],
                'border' => 0
            ],
            (new RichTextPreformattedElement())
                ->addElement(
                    (new EmojiType())
                        ->setName('wave')
                )
                ->setBorder(0)
                ->toArray()
        );
    }
}
