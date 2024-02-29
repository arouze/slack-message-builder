<?php

namespace Arouze\Tests\Objects\RichText;

use Arouze\SlackMessageBuilder\Objects\RichText\ChannelType;
use Arouze\Tests\AbstractSlackMessageBuilderBaseTestCase;
use PHPUnit\Framework\Attributes\Group;

#[Group("ChannelType")]
#[Group("RichText")]
#[Group("Objects")]
class ChannelTypeTest extends AbstractSlackMessageBuilderBaseTestCase
{
    public function testSimpleChannelType(): void
    {
        self::assertEquals(
            [
                'type' => 'channel',
                'channel_id' => '123456'
            ],
            (new ChannelType())
                ->setChannelId('123456')
                ->toArray()
        );
    }

    public function testChannelTypeWithStyle(): void
    {
        self::assertEquals(
            [
                'type' => 'channel',
                'channel_id' => '123456',
                'style' => 'bold'
            ],
            (new ChannelType())
                ->setChannelId('123456')
                ->setStyle(ChannelType::STYLE_BOLD)
                ->toArray()
        );
    }
}
