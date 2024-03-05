<?php

namespace Arouze\Tests\Elements\RichText;

use Arouze\SlackMessageBuilder\Elements\RichText\RichTextQuoteElement;
use Arouze\SlackMessageBuilder\Objects\RichText\ChannelType;
use Arouze\SlackMessageBuilder\Objects\RichText\EmojiType;
use Arouze\Tests\AbstractSlackMessageBuilderBaseTestCase;
use PHPUnit\Framework\Attributes\Group;

#[Group("RichTextQuoteElement")]
#[Group("RichText")]
#[Group("Elements")]
class RichTextQuoteElementTest extends AbstractSlackMessageBuilderBaseTestCase
{
    public function testRichTextQuoteElement(): void
    {
        self::assertEquals(
            [
                'type' => 'rich_text_quote',
                'elements' => [
                    [
                        'type' => 'channel',
                        'channel_id' => '123456'
                    ]
                ]
            ],
            (new RichTextQuoteElement())
                ->addElement(
                    (new ChannelType())
                        ->setChannelId('123456')
                )
                ->toArray()
        );
    }

    public function testRichTextQuoteElementWithBorder(): void
    {
        self::assertEquals(
            [
                'type' => 'rich_text_quote',
                'elements' => [
                    [
                        'type' => 'emoji',
                        'name' => 'wave'
                    ]
                ],
                'border' => 0
            ],
            (new RichTextQuoteElement())
                ->addElement(
                    (new EmojiType())
                        ->setName('wave')
                )
                ->setBorder(0)
                ->toArray()
        );
    }
}
