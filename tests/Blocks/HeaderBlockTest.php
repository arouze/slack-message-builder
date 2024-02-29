<?php

namespace Arouze\Tests\Blocks;

use Arouze\SlackMessageBuilder\Blocks\HeaderBlock;
use Arouze\SlackMessageBuilder\Exceptions\TooLongBlockIdException;
use Arouze\SlackMessageBuilder\Exceptions\TooLongTextException;
use Arouze\Tests\AbstractSlackMessageBuilderBaseTestCase;
use PHPUnit\Framework\Attributes\Group;

#[Group("HeaderBlock")]
#[Group("Blocks")]
class HeaderBlockTest extends AbstractSlackMessageBuilderBaseTestCase
{
    public function testSectionBlockWithAccessory(): void
    {
        $text = $this->fakerGenerator->text(20);
        self::assertEquals(
            [
                'type' => 'header',
                'text' => [
                    'type' => 'plain_text',
                    'text' => $text
                ]
            ],
            (new HeaderBlock())
                ->setTextObject(self::buildTextObject()->setText($text))
                ->toArray()
        );
    }

    public function testTooLongHeaderTextException(): void
    {
        self::expectException(TooLongTextException::class);

        (new HeaderBlock())
            ->setTextObject(
                self::buildTextObject()
                ->setText(
                    $this->fakerGenerator->realTextBetween(151)
                )
            )
            ->toArray();
    }

    public function testTooLongBlockIdException(): void
    {
        self::expectException(TooLongBlockIdException::class);

        (new HeaderBlock())
            ->setTextObject(
                self::buildTextObject()
                    ->setText(
                        $this->fakerGenerator->text(150)
                    )
            )
            ->setBlockId(
                $this->fakerGenerator->realTextBetween(256, 300)
            )
            ->toArray();
    }
}
