<?php

namespace Arouze\Tests\Objects;

use Arouze\SlackMessageBuilder\Exceptions\TooLongTextException;
use Arouze\SlackMessageBuilder\Exceptions\TooShortTextException;
use Arouze\SlackMessageBuilder\Objects\TextObject;
use Arouze\Tests\AbstractSlackMessageBuilderBaseTestCase;
use PHPUnit\Framework\Attributes\Group;

 #[Group("TextObject")]
 #[Group("Objects")]
class TextObjectTest extends AbstractSlackMessageBuilderBaseTestCase
{
    public function testSimpleTextObject(): void
    {
        $text = $this->fakerGenerator->text();

        self::assertEquals(
            [
                'type' => 'plain_text',
                'text' => $text
            ],
            (new TextObject())
                ->setType(TextObject::TEXT_OBJECT_TYPE_PLAIN_TEXT)
                ->setText($text)
                ->toArray()
        );
    }

     public function testEscapeEmoji(): void
     {
         $text = $this->fakerGenerator->text();

         self::assertEquals(
             [
                 'type' => 'plain_text',
                 'text' => $text,
                 'emoji' => true
             ],
             (new TextObject())
                 ->setType(TextObject::TEXT_OBJECT_TYPE_PLAIN_TEXT)
                 ->setText($text)
                 ->escapeEmoji()
                 ->toArray()
         );
     }

     public function testEnableVerbatim(): void
     {
         $text = $this->fakerGenerator->text();

         self::assertEquals(
             [
                 'type' => 'mrkdwn',
                 'text' => $text,
                 'verbatim' => true
             ],
             (new TextObject())
                 ->setType(TextObject::TEXT_OBJECT_TYPE_MARKDOWN)
                 ->setText($text)
                 ->enableVerbatim()
                 ->toArray()
         );
     }

    public function testTooLongTextException(): void
    {
        self::expectException(TooLongTextException::class);

        (new TextObject())->setText(
            $this->fakerGenerator->realTextBetween(3001, 3300)
        )->toArray();
    }

     public function testTooShortTextException(): void
     {
         self::expectException(TooShortTextException::class);

         (new TextObject())->setText('')->toArray();
     }
}
