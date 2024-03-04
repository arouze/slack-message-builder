<?php

namespace Arouze\Tests\Elements;

use Arouze\SlackMessageBuilder\Elements\UrlInputElement;
use Arouze\Tests\AbstractSlackMessageBuilderBaseTestCase;
use PHPUnit\Framework\Attributes\Group;

#[Group("UrlInputElement")]
#[Group("Elements")]
class UrlInputElementTest extends AbstractSlackMessageBuilderBaseTestCase
{
    public function testUrlInputElement(): void
    {
        self::assertEquals(
            [
                'type' => 'url_text_input'
            ],
            (new UrlInputElement())
                ->toArray()
        );
    }
}
