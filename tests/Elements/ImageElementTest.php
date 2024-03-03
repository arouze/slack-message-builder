<?php

namespace Arouze\Tests\Elements;

use Arouze\SlackMessageBuilder\Elements\ImageElement;
use Arouze\SlackMessageBuilder\Exceptions\MissingFieldException;
use Arouze\SlackMessageBuilder\Exceptions\TooLongTextException;
use Arouze\Tests\AbstractSlackMessageBuilderBaseTestCase;
use PHPUnit\Framework\Attributes\Group;

#[Group("ImageElement")]
#[Group("Elements")]
class ImageElementTest extends AbstractSlackMessageBuilderBaseTestCase
{
    public function testImageElement(): void
    {
        $altText = $this->fakerGenerator->text();
        $imageUrl = $this->fakerGenerator->imageUrl();

        self::assertEquals(
            [
                'type' => 'image',
                'alt_text' => $altText,
                'image_url' => $imageUrl
            ],
            (new ImageElement())
                ->setAltText($altText)
                ->setImageUrl($imageUrl)
                ->toArray()
        );
    }

    public function testImageElementWithSlackFile(): void
    {
        $altText = $this->fakerGenerator->text();
        $slackFile = self::buildSlackFile();

        self::assertEquals(
            [
                'type' => 'image',
                'alt_text' => $altText,
                'slack_file' => $slackFile->toArray()
            ],
            (new ImageElement())
                ->setAltText($altText)
                ->setSlackFile($slackFile)
                ->toArray()
        );
    }

    public function testMissingFieldException(): void
    {
        self::expectException(MissingFieldException::class);

        (new ImageElement())->setAltText($this->fakerGenerator->text(20))->toArray();
    }

    public function testImageUrlException(): void
    {
        self::expectException(TooLongTextException::class);

        (new ImageElement())
            ->setImageUrl(
                $this->fakerGenerator->realTextBetween(3001, 3300)
            )
            ->toArray();
    }

    public function testTextLengthException(): void
    {
        self::expectException(TooLongTextException::class);

        $textObject = self::buildTextObject()
            ->setText(
                $this->fakerGenerator->realTextBetween(2001, 3000)
            );

        (new ImageElement())
        ->setTitle($textObject)
        ->toArray();
    }
}
