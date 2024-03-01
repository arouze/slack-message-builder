<?php

namespace Arouze\Tests;

use Arouze\SlackMessageBuilder\Objects\ButtonTextObject;
use Arouze\SlackMessageBuilder\Objects\ConfirmationDialogObject;
use Arouze\SlackMessageBuilder\Objects\ImageObject;
use Arouze\SlackMessageBuilder\Objects\OptionObject;
use Arouze\SlackMessageBuilder\Objects\TextObject;

trait ObjectBuilderTrait
{
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

    protected static function buildOptionObject(?string $value = 'Option value'): OptionObject
    {
        return (new OptionObject())
            ->setText(self::buildTextObject())
            ->setValue($value);
    }
}
