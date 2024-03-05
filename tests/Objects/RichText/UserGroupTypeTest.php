<?php

namespace Arouze\Tests\Objects\RichText;

use Arouze\SlackMessageBuilder\Objects\RichText\UserGroupType;
use Arouze\Tests\AbstractSlackMessageBuilderBaseTestCase;
use PHPUnit\Framework\Attributes\Group;

#[Group("UserGroupType")]
#[Group("RichText")]
#[Group("Objects")]
class UserGroupTypeTest extends AbstractSlackMessageBuilderBaseTestCase
{
    public function testUserGroupType(): void
    {
        self::assertEquals(
            [
                'type' => 'usergroup',
                'usergroup_id' => '123ABC'
            ],
            (new UserGroupType())
                ->setUserGroupId('123ABC')
                ->toArray()
        );
    }

    public function testUserGroupTypeWithStyle(): void
    {
        self::assertEquals(
            [
                'type' => 'usergroup',
                'usergroup_id' => '123ABC',
                'style' => [
                    'bold' => true
                ]
            ],
            (new UserGroupType())
                ->setUserGroupId('123ABC')
                ->addStyle(UserGroupType::STYLE_BOLD)
                ->toArray()
        );
    }
}
