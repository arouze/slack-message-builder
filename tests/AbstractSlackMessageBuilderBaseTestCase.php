<?php

namespace Arouze\Tests;

use Arouze\SlackMessageBuilder\Accessories\ImageAccessory;
use Arouze\SlackMessageBuilder\Elements\ButtonElement;
use Arouze\SlackMessageBuilder\Objects\ButtonTextObject;
use Arouze\SlackMessageBuilder\Objects\TextObject;
use PHPUnit\Framework\TestCase;

abstract class AbstractSlackMessageBuilderBaseTestCase extends TestCase
{
    protected string $moreThan3000CharText = '
Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nam sed dapibus sem. Nunc hendrerit, odio et euismod blandit, velit ipsum semper quam, quis viverra dolor odio quis mauris. Aenean nec augue enim. Donec magna metus, semper sed erat eu, imperdiet suscipit purus. Proin id placerat orci, vel finibus libero. Aliquam erat volutpat. Nunc id ligula ultricies erat scelerisque euismod sed ut arcu. Proin elementum, neque vitae egestas aliquam, magna augue pulvinar augue, eu congue neque velit id felis. Suspendisse lacus risus, condimentum sed efficitur ac, aliquet vitae nibh. Ut hendrerit accumsan bibendum. Nulla eu augue eget purus auctor mollis sed vitae tortor. Duis bibendum dui ac ante fermentum, vel pretium diam laoreet.
Curabitur accumsan ligula ut odio ullamcorper ultrices. Praesent congue volutpat turpis, at ullamcorper lectus congue nec. Etiam purus lorem, varius sit amet mi a, dignissim convallis magna. Suspendisse orci tortor, rhoncus eget pulvinar nec, lobortis sit amet tortor. Duis vitae lobortis odio, ut luctus dui. Morbi rhoncus mi nec lectus facilisis, et bibendum ligula interdum. Integer sit amet suscipit risus. Phasellus et nulla quam. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Curabitur tincidunt sem eu eros pharetra, ac feugiat ipsum cursus. Fusce viverra facilisis faucibus. Nulla molestie erat eget lectus pharetra aliquet. Phasellus dapibus tellus augue, eu volutpat nibh fringilla at.
Donec convallis diam nec fermentum lacinia. Nam sed elit imperdiet, cursus neque at, euismod massa. Donec vitae libero ac turpis mollis vehicula a non neque. Duis est est, vehicula ut felis eu, tristique tristique dui. Sed feugiat vel enim nec lacinia. Donec venenatis, diam in convallis sodales, metus sem volutpat mauris, vel vehicula lorem mauris a mi. Nam nisl massa, tempus non ipsum at, ullamcorper vehicula augue. Vivamus feugiat malesuada posuere. Quisque lobortis odio sit amet quam posuere gravida. Ut elit lectus, tincidunt a lacinia non, tempus quis ante.
Fusce eget euismod tellus. Proin scelerisque, ante sed molestie tincidunt, leo augue pulvinar sem, sit amet ullamcorper sem enim hendrerit nibh. Vestibulum eleifend aliquam est, vel pulvinar nibh rhoncus vitae. Vivamus dui ipsum, molestie quis orci vitae, tempor pharetra ex. Duis pulvinar, tellus id aliquet vehicula, ligula tellus blandit sem, et semper sapien ipsum eget turpis. Nam commodo libero eu lectus sagittis, vel suscipit augue dictum. Sed vel urna ut quam laoreet sollicitudin. Phasellus cursus ultricies turpis vel imperdiet. Interdum et malesuada fames ac ante ipsum primis in faucibus. Duis pulvinar magna ligula, a aliquet dolor finibus id. Nullam metus mi, tristique eget enim sit amet, consectetur scelerisque ex. In molestie diam eu ultricies rhoncus. Mauris in justo non nisi rhoncus finibus vitae vitae nisl. Aliquam tristique lacus sapien, sit amet condimentum mi consectetur id. Suspendisse vel tellus lacinia felis consequat ultrices. Duis aliquam nibh ac erat efficitur.
';

    protected static function buildTextObject(): TextObject
    {
        return (new TextObject())->setText('Simple text.');
    }

    protected static function buildImageAccessory(): ImageAccessory
    {
        return (new ImageAccessory())
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
