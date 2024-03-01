<?php

namespace Arouze\Tests\Blocks;

use Arouze\SlackMessageBuilder\Blocks\ImageBlock;
use Arouze\SlackMessageBuilder\Exceptions\MissingFieldException;
use Arouze\SlackMessageBuilder\Exceptions\TooLongTextException;
use Arouze\Tests\AbstractSlackMessageBuilderBaseTestCase;
use PHPUnit\Framework\Attributes\Group;

#[Group("ImageBlock")]
#[Group("Blocks")]
class ImageBlockTest extends AbstractSlackMessageBuilderBaseTestCase
{
    public function testImageBlock(): void
    {
        $altText = $this->fakerGenerator->text();
        $imageUrl = $this->fakerGenerator->imageUrl();
        $title = self::buildTextObject();

        self::assertEquals(
            [
                'type' => 'image',
                'alt_text' => $altText,
                'image_url' => $imageUrl,
                'title' => $title->toArray()
            ],
            (new ImageBlock())
            ->setAltText($altText)
            ->setImageUrl($imageUrl)
            ->setTitle($title)
            ->toArray()
        );
    }

    public function testTooLongAltTextException(): void
    {
        self::expectException(TooLongTextException::class);

        (new ImageBlock())
            ->setAltText(
                $this->fakerGenerator->realTextBetween(2001, 3000)
            )
            ->setImageUrl($this->fakerGenerator->imageUrl())
            ->toArray();
    }

    public function testMissingImageUrlAndSlackFileException(): void
    {
        self::expectException(MissingFieldException::class);

        (new ImageBlock())
            ->setAltText(
                $this->fakerGenerator->text()
            )
            ->toArray();
    }

    public function testTooLongTitleException(): void
    {
        self::expectException(TooLongTextException::class);

        $title = self::buildTextObject();

        $title->setText($this->fakerGenerator->realTextBetween(2001, 3000));

        (new ImageBlock())
            ->setAltText(
                $this->fakerGenerator->text()
            )
            ->setTitle($title)
            ->setImageUrl($this->fakerGenerator->imageUrl())
            ->toArray();
    }
}
