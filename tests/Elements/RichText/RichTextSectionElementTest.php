<?php

namespace Arouze\Tests\Elements\RichText;

use Arouze\SlackMessageBuilder\Elements\RichText\RichTextSectionElement;
use Arouze\SlackMessageBuilder\Objects\RichText\ChannelType;
use Arouze\Tests\AbstractSlackMessageBuilderBaseTestCase;
use PHPUnit\Framework\Attributes\Group;

#[Group("RichTextSectionElement")]
#[Group("RichText")]
#[Group("Elements")]
class RichTextSectionElementTest extends AbstractSlackMessageBuilderBaseTestCase
{
    public function testRichTextSectionElement(): void
    {
        self::assertEquals(
            [
                'type' => 'rich_text_section',
                'elements' => [
                    [
                        'type' => 'channel',
                        'channel_id' => '123456'
                    ]
                ]
            ],
            (new RichTextSectionElement())
                ->addElement(
                    (new ChannelType())
                        ->setChannelId('123456')
                )
                ->toArray()
        );
    }
}
