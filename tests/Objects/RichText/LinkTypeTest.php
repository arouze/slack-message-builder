<?php

namespace Arouze\Tests\Objects\RichText;

use Arouze\SlackMessageBuilder\Objects\RichText\LinkType;
use Arouze\Tests\AbstractSlackMessageBuilderBaseTestCase;
use PHPUnit\Framework\Attributes\Group;

#[Group("LinkType")]
#[Group("RichText")]
#[Group("Objects")]
class LinkTypeTest extends AbstractSlackMessageBuilderBaseTestCase
{
    public function testLinkType(): void
    {
        $url = $this->fakerGenerator->url();
        self::assertEquals(
            [
                'type' => 'link',
                'url' => $url
            ],
            (new LinkType())
                ->setUrl($url)
                ->toArray()
        );
    }

    public function testLinkTypeWithText(): void
    {
        $url = $this->fakerGenerator->url();
        $text = $this->fakerGenerator->text();

        self::assertEquals(
            [
                'type' => 'link',
                'url' => $url,
                'text' => $text
            ],
            (new LinkType())
                ->setUrl($url)
                ->setText($text)
                ->toArray()
        );
    }

    public function testLinkTypeWithUnsafe(): void
    {
        $url = $this->fakerGenerator->url();

        self::assertEquals(
            [
                'type' => 'link',
                'url' => $url,
                'unsafe' => true
            ],
            (new LinkType())
                ->setUrl($url)
                ->markHasUnsafeLink()
                ->toArray()
        );
    }

    public function testLinkTypeWithStyle(): void
    {
        $url = $this->fakerGenerator->url();
        self::assertEquals(
            [
                'type' => 'link',
                'url' => $url,
                'style' => [
                    'code' => true
                ]
            ],
            (new LinkType())
                ->setUrl($url)
                ->addStyle(LinkType::STYLE_CODE)
                ->toArray()
        );
    }
}
