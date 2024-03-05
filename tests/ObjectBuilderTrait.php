<?php

namespace Arouze\Tests;

use Arouze\SlackMessageBuilder\Elements\ImageElement;
use Arouze\SlackMessageBuilder\Objects\ConfirmationDialogObject;
use Arouze\SlackMessageBuilder\Objects\OptionGroupObject;
use Arouze\SlackMessageBuilder\Objects\OptionObject;
use Arouze\SlackMessageBuilder\Objects\SlackFileObject;
use Arouze\SlackMessageBuilder\Objects\TextObject;
use Arouze\SlackMessageBuilder\Objects\TriggerObject;
use Arouze\SlackMessageBuilder\Objects\WorkflowObject;

trait ObjectBuilderTrait
{
    protected static function buildTextObject(): TextObject
    {
        return (new TextObject())->setText('Simple text.');
    }

    protected static function buildImageObject(): ImageElement
    {
        return (new ImageElement())
            ->setAltText('Alt text')
            ->setImageUrl('https://s3-media3.fl.yelpcdn.com/bphoto/c7ed05m9lC2EmA3Aruue7A/o.jpg');
    }

    protected static function buildSlackFile(
        ?string $url = null,
        ?string $id = null
    ): SlackFileObject
    {
        if (is_null($url)) {
            $url = 'https://s3-media3.fl.yelpcdn.com/bphoto/c7ed05m9lC2EmA3Aruue7A/o.jpg';
        }

        if (is_null($id)) {
            $id = '123ABC';
        }

        return (new SlackFileObject())
            ->setUrl($url)
            ->setId($id);
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

    protected static function buildOptionGroupObject(?OptionObject $optionObject = null): OptionGroupObject
    {
        $optionGroupObject = (new OptionGroupObject())
            ->setLabel(self::buildTextObject());

        if (is_null($optionObject)) {
            $optionObject = self::buildOptionObject();
        }

        $optionGroupObject->addOption($optionObject);

        return $optionGroupObject;
    }

    protected function buildTriggerObject(string $url): TriggerObject
    {
        return (new TriggerObject())->setUrl($url);
    }

    protected function buildWorkflowObject(string $url): WorkflowObject
    {
        return (new WorkflowObject())
            ->setTrigger(self::buildTriggerObject($url));
    }
}
