<?php

namespace Arouze\Tests\Objects\RichText;

use Arouze\SlackMessageBuilder\Objects\RichText\TextType;
use Arouze\Tests\AbstractSlackMessageBuilderBaseTestCase;
use PHPUnit\Framework\Attributes\Group;

#[Group("TextType")]
#[Group("RichText")]
#[Group("Objects")]
class TextTypeTest extends AbstractSlackMessageBuilderBaseTestCase
{
    public function testTextType(): void
    {
        self::assertEquals(
            [
                'type' => 'text'
            ],
            (new TextType())
                ->toArray()
        );
    }

    public function testTextTypeWithStyle(): void
    {
        self::assertEquals(
            [
                'type' => 'text',
                'style' => [
                    'bold' => true
                ]
            ],
            (new TextType())
                ->addStyle(TextType::STYLE_BOLD)
                ->toArray()
        );
    }
}
