<?php

namespace Arouze\Tests\Objects\RichText;

use Arouze\SlackMessageBuilder\Objects\RichText\UserType;
use Arouze\Tests\AbstractSlackMessageBuilderBaseTestCase;
use PHPUnit\Framework\Attributes\Group;

#[Group("UserType")]
#[Group("RichText")]
#[Group("Objects")]
class UserTypeTest extends AbstractSlackMessageBuilderBaseTestCase
{
    public function testUserType(): void
    {
        self::assertEquals(
            [
                'type' => 'user',
                'user_id' => '123ABC'
            ],
            (new UserType())
                ->setUserId('123ABC')
                ->toArray()
        );
    }

    public function testUserTypeWithStyle(): void
    {
        self::assertEquals(
            [
                'type' => 'user',
                'user_id' => '123ABC',
                'style' => [
                    'bold' => true
                ]
            ],
            (new UserType())
                ->setUserId('123ABC')
                ->addStyle(UserType::STYLE_BOLD)
                ->toArray()
        );
    }
}
