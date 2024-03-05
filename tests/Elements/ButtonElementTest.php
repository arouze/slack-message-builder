<?php

namespace Arouze\Tests\Elements;

use Arouze\SlackMessageBuilder\Elements\ButtonElement;
use Arouze\SlackMessageBuilder\Exceptions\TooLongTextException;
use Arouze\Tests\AbstractSlackMessageBuilderBaseTestCase;
use PHPUnit\Framework\Attributes\Group;

#[Group("ButtonElement")]
#[Group("Elements")]
class ButtonElementTest extends AbstractSlackMessageBuilderBaseTestCase
{
    public function testButtonElement(): void
    {
        $textObject = self::buildTextObject();
        self::assertEquals(
            [
                'type' => 'button',
                'text' => $textObject->toArray()
            ],
            (new ButtonElement())
                ->setText($textObject)
                ->toArray()
        );
    }

    public function testButtonElementWithDefaultStyle(): void
    {
        $buttonElement = (new ButtonElement())
            ->setText(self::buildTextObject())
            ->setStyle(ButtonElement::BUTTON_STYLE_DEFAULT)
            ->toArray();

        self::assertArrayNotHasKey('style', $buttonElement);
    }

    public function testButtonElementWithPrimaryStyle(): void
    {
        $buttonElement = (new ButtonElement())
            ->setText(self::buildTextObject())
            ->setStyle(ButtonElement::BUTTON_STYLE_PRIMARY)
            ->toArray();

        self::assertArrayHasKey('style', $buttonElement);
        self::assertEquals(ButtonElement::BUTTON_STYLE_PRIMARY, $buttonElement['style']);
    }

    public function testButtonElementWithConfirm(): void
    {
        $textObject = self::buildTextObject();
        $confirmDialogObject = self::buildConfirmDialogObjectElement();

        self::assertEquals(
            [
                'type' => 'button',
                'text' => $textObject->toArray(),
                'confirm' => $confirmDialogObject->toArray()
            ],
            (new ButtonElement())
                ->setText($textObject)
                ->setConfirm($confirmDialogObject)
                ->toArray()
        );
    }

    public function testButtonElementWithActionId(): void
    {
        $textObject = self::buildTextObject();
        $actionId = $this->fakerGenerator->text();
        self::assertEquals(
            [
                'type' => 'button',
                'text' => $textObject->toArray(),
                'action_id' => $actionId
            ],
            (new ButtonElement())
                ->setText($textObject)
                ->setActionId($actionId)
                ->toArray()
        );
    }

    public function testTooLongTextException(): void
    {
        self::expectException(TooLongTextException::class);

        $text = self::buildTextObject();
        $text->setText($this->fakerGenerator->realTextBetween(76));

        (new ButtonElement())
            ->setText($text)
            ->toArray();
    }

    public function testTooLongUrlException(): void
    {
        self::expectException(TooLongTextException::class);

        $text = self::buildTextObject();

        (new ButtonElement())
            ->setText($text)
            ->setUrl($this->fakerGenerator->realTextBetween(3001, 3300))
            ->toArray();
    }

    public function testTooAccessibilityLabelException(): void
    {
        self::expectException(TooLongTextException::class);

        $text = self::buildTextObject();

        (new ButtonElement())
            ->setText($text)
            ->setAccessibilityLabel(
                $this->fakerGenerator->realTextBetween(76)
            )
            ->toArray();
    }
}
