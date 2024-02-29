<?php

namespace Arouze\Tests\Objects;

use Arouze\SlackMessageBuilder\Exceptions\MissingFieldException;
use Arouze\SlackMessageBuilder\Exceptions\TooLongImageUrlException;
use Arouze\SlackMessageBuilder\Exceptions\TooLongTitleException;
use Arouze\SlackMessageBuilder\Objects\ImageObject;
use Arouze\Tests\AbstractSlackMessageBuilderBaseTestCase;
use PHPUnit\Framework\Attributes\Group;

#[Group("ImageObject")]
#[Group("Objects")]
class ImageObjectTest extends AbstractSlackMessageBuilderBaseTestCase
{
    public function testSimpleImageObject(): void
    {
        self::assertEquals(
            [
                'type' => 'image',
                'alt_text' => 'Alt text',
                'image_url' => 'https://s3-media3.fl.yelpcdn.com/bphoto/c7ed05m9lC2EmA3Aruue7A/o.jpg'
            ],
            (new ImageObject())
                ->setAltText('Alt text')
                ->setImageUrl('https://s3-media3.fl.yelpcdn.com/bphoto/c7ed05m9lC2EmA3Aruue7A/o.jpg')
                ->toArray()
        );
    }

    public function testMissingFieldException(): void
    {
        self::expectException(MissingFieldException::class);

        (new ImageObject())->setAltText($this->fakerGenerator->text(20))->toArray();
    }

    public function testImageUrlException(): void
    {
        self::expectException(TooLongImageUrlException::class);

        (new ImageObject())->setImageUrl($this->fakerGenerator->realTextBetween(3001, 3300));
    }

    public function testTextLengthException(): void
    {
        self::expectException(TooLongTitleException::class);

        $textObject = self::buildTextObject()->setText($this->fakerGenerator->realTextBetween(2001, 3000));

        (new ImageObject())->setTitle($textObject);
    }
}
