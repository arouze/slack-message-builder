<?php

namespace Arouze\Tests;

use Arouze\SlackMessageBuilder\Elements\ButtonElement;
use Arouze\SlackMessageBuilder\Elements\DateTimePickerElement;
use Arouze\SlackMessageBuilder\Objects\ButtonTextObject;
use Arouze\SlackMessageBuilder\Objects\ConfirmationDialogObject;
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
            ->setText(self::buildButtonTextObject());
    }

    protected static function buildConfirmDialogObjectElement(): ConfirmationDialogObject
    {
        $titleObject = self::buildTextObject();
        $titleObject->setText('Are you sure?');

        $textObject = self::buildTextObject();
        $textObject->setText("Wouldn't you prefer a good game of chess?");

        $confirm = self::buildTextObject();
        $confirm->setText('Do it');

        $deny = self::buildTextObject();
        $deny->setText("Stop, I've changed my mind!");

        return (new ConfirmationDialogObject())
            ->setTitle($titleObject)
            ->setText($textObject)
            ->setConfirm($confirm)
            ->setDeny($deny);
    }
    protected static function buildDateTimePickerElement(): DateTimePickerElement
    {
        return (new DateTimePickerElement());
    }
}
