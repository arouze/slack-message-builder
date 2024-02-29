<?php

namespace Arouze\Tests;

use Arouze\SlackMessageBuilder\Elements\ButtonElement;
use Arouze\SlackMessageBuilder\Objects\ButtonTextObject;
use Arouze\SlackMessageBuilder\Objects\ImageObject;
use Arouze\SlackMessageBuilder\Objects\TextObject;
use Faker\Factory;
use Faker\Generator;
use PHPUnit\Framework\TestCase;

abstract class AbstractSlackMessageBuilderBaseTestCase extends TestCase
{
    protected Generator $fakerGenerator;
    public function __construct(string $name)
    {
        $this->fakerGenerator = Factory::create();
        parent::__construct($name);
    }

    protected static function buildTextObject(): TextObject
    {
        return (new TextObject())->setText('Simple text.');
    }

    protected static function buildImageObject(): ImageObject
    {
        return (new ImageObject())
            ->setAltText('Alt text')
            ->setImageUrl('https://s3-media3.fl.yelpcdn.com/bphoto/c7ed05m9lC2EmA3Aruue7A/o.jpg');
    }

    protected static function buildButtonTextObject(): ButtonTextObject
    {
        return (new ButtonTextObject())
            ->setText('Simple button text.');
    }

    protected static function buildButtonElement(): ButtonElement
    {
        return (new ButtonElement())
            ->setButtonTextObject(self::buildButtonTextObject());
    }
}
