<?php

namespace Arouze\Tests\Elements;

use Arouze\SlackMessageBuilder\Elements\ButtonElement;
use Arouze\Tests\AbstractSlackMessageBuilderBaseTestCase;
use PHPUnit\Framework\Attributes\Group;

#[Group("ButtonElement")]
#[Group("Elements")]
class ButtonElementTest extends AbstractSlackMessageBuilderBaseTestCase
{
    public function testSimpleButtonElement(): void
    {
        self::assertEquals(
            [
                'type' => 'button',
                'text' => [
                    'type' => 'plain_text',
                    'text' => 'Simple button text.'
                ]
            ],
            (new ButtonElement())
                ->setButtonTextObject(self::buildButtonTextObject())
                ->toArray()
        );
    }

    public function testSimpleButtonElementWithDefaultStyle(): void
    {
        $buttonElement = (new ButtonElement())
            ->setButtonTextObject(self::buildButtonTextObject())
            ->setStyle(ButtonElement::BUTTON_STYLE_DEFAULT)
            ->toArray();

        self::assertArrayNotHasKey('style', $buttonElement);
    }

    public function testSimpleButtonElementWithPrimaryStyle(): void
    {
        $buttonElement = (new ButtonElement())
            ->setButtonTextObject(self::buildButtonTextObject())
            ->setStyle(ButtonElement::BUTTON_STYLE_PRIMARY)
            ->toArray();

        self::assertArrayHasKey('style', $buttonElement);
        self::assertEquals(ButtonElement::BUTTON_STYLE_PRIMARY, $buttonElement['style']);
    }
}
