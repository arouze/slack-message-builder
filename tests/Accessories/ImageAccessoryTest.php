<?php

namespace Arouze\Tests\Accessories;

use Arouze\SlackMessageBuilder\Accessories\ImageAccessory;
use Arouze\SlackMessageBuilder\Exceptions\MissingFieldException;
use Arouze\SlackMessageBuilder\Exceptions\TooLongImageUrlException;
use Arouze\Tests\AbstractSlackMessageBuilderBaseTestCase;
use PHPUnit\Framework\Attributes\Group;

#[Group("ImageAccessory")]
#[Group("Accessories")]
class ImageAccessoryTest extends AbstractSlackMessageBuilderBaseTestCase
{
    public function testSimpleImageAccessory(): void
    {
        self::assertEquals(
            [
                'type' => 'image',
                'alt_text' => 'Alt text',
                'image_url' => 'https://s3-media3.fl.yelpcdn.com/bphoto/c7ed05m9lC2EmA3Aruue7A/o.jpg'
            ],
            (new ImageAccessory())
                ->setAltText('Alt text')
                ->setImageUrl('https://s3-media3.fl.yelpcdn.com/bphoto/c7ed05m9lC2EmA3Aruue7A/o.jpg')
                ->toArray()
        );
    }

    public function testMissingFieldException(): void
    {
        self::expectException(MissingFieldException::class);

        (new ImageAccessory())->toArray();
    }

    public function testImageUrlException(): void
    {
        self::expectException(TooLongImageUrlException::class);

        (new ImageAccessory())->setImageUrl($this->moreThan3000CharText);
    }
}
