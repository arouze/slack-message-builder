<?php

namespace Arouze\Tests\Objects;

use Arouze\SlackMessageBuilder\Exceptions\IncorrectIncludeException;
use Arouze\SlackMessageBuilder\Objects\ConversationFilterObject;
use Arouze\Tests\AbstractSlackMessageBuilderBaseTestCase;

class ConversationFilterObjectTest extends AbstractSlackMessageBuilderBaseTestCase
{
    public function testConversationFilterObjectWithInclude(): void
    {
        self::assertEquals(
            [
                'filter' => [
                    'include' => [
                        'public'
                    ]
                ]
            ],
            (new ConversationFilterObject())
                ->addInclude(ConversationFilterObject::INCLUDE_PUBLIC)
                ->toArray()
        );
    }

    public function testConversationFilterObjectWithExcludeExternalSharedChannels(): void
    {
        self::assertEquals(
            [
                'filter' => [
                    'include' => [
                        'public'
                    ],
                    'exclude_external_shared_channels' => true
                ]
            ],
            (new ConversationFilterObject())
                ->addInclude(ConversationFilterObject::INCLUDE_PUBLIC)
                ->excludeExternalSharedChannel()
                ->toArray()
        );
    }

    public function testConversationFilterObjectWithExcludeBotUsers(): void
    {
        self::assertEquals(
            [
                'filter' => [
                    'include' => [
                        'public'
                    ],
                    'exclude_bot_users' => true
                ]
            ],
            (new ConversationFilterObject())
                ->addInclude(ConversationFilterObject::INCLUDE_PUBLIC)
                ->excludeBotUser()
                ->toArray()
        );
    }

    public function testConversationFilterObjectWithIncorrectIncludeException(): void
    {
        self::expectException(IncorrectIncludeException::class);

        (new ConversationFilterObject())
            ->addInclude('incorrect')
            ->toArray();
    }
}
