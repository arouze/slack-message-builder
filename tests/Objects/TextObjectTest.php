<?php

namespace Arouze\Tests\Objects;

use Arouze\SlackMessageBuilder\Exceptions\TooLongButtonObjectTextException;
use Arouze\SlackMessageBuilder\Objects\TextObject;
use Arouze\Tests\AbstractSlackMessageBuilderBaseTestCase;
use PHPUnit\Framework\Attributes\Group;

 #[Group("TextObject")]
 #[Group("Objects")]
class TextObjectTest extends AbstractSlackMessageBuilderBaseTestCase
{
    public function testSimpleTextObject(): void
    {
        self::assertEquals(
            [
                'type' => 'plain_text',
                'text' => "Simple text."
            ],
            (new TextObject())
                ->setType(TextObject::TEXT_OBJECT_TYPE_PLAIN_TEXT)
                ->setText("Simple text.")
                ->toArray()
        );
    }

    public function testTooLongTextException(): void
    {
        self::expectException(TooLongButtonObjectTextException::class);

        (new TextObject())->setText(
            $this->fakerGenerator->realTextBetween(3001, 3300)
        );
    }
}
