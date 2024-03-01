<?php

namespace Arouze\Tests\Objects;

use Arouze\SlackMessageBuilder\Exceptions\TooLongTextException;
use Arouze\SlackMessageBuilder\Objects\ConfirmationDialogObject;
use Arouze\Tests\AbstractSlackMessageBuilderBaseTestCase;
use PHPUnit\Framework\Attributes\Group;

#[Group("ConfirmationDialogObject")]
#[Group("Objects")]
class ConfirmationDialogObjectTest extends AbstractSlackMessageBuilderBaseTestCase
{
    public function testSimpleConfirmationDialogObject(): void
    {
        $titleObject = self::buildTextObject();
        $titleObject->setText($this->fakerGenerator->text(100));

        $textObject = self::buildTextObject();
        $textObject->setText($this->fakerGenerator->text(300));

        $confirm = self::buildTextObject();
        $confirm->setText($this->fakerGenerator->text(30));


        $deny = self::buildTextObject();
        $deny->setText($this->fakerGenerator->text(30));

        self::assertEquals(
            [
                'title' => $titleObject->toArray(),
                'text' => $textObject->toArray(),
                'confirm' => $confirm->toArray(),
                'deny' => $deny->toArray(),
            ],
            (new ConfirmationDialogObject())
                ->setTitle($titleObject)
                ->setText($textObject)
                ->setConfirm($confirm)
                ->setDeny($deny)
                ->toArray()
        );
    }

    public function testSimpleConfirmationDialogObjectWithDangerStyle(): void
    {
        $titleObject = self::buildTextObject();
        $titleObject->setText($this->fakerGenerator->text(100));

        $textObject = self::buildTextObject();
        $textObject->setText($this->fakerGenerator->text(300));

        $confirm = self::buildTextObject();
        $confirm->setText($this->fakerGenerator->text(30));


        $deny = self::buildTextObject();
        $deny->setText($this->fakerGenerator->text(30));

        self::assertEquals(
            [
                'title' => $titleObject->toArray(),
                'text' => $textObject->toArray(),
                'confirm' => $confirm->toArray(),
                'deny' => $deny->toArray(),
                'style' => 'danger'
            ],
            (new ConfirmationDialogObject())
                ->setTitle($titleObject)
                ->setText($textObject)
                ->setConfirm($confirm)
                ->setDeny($deny)
                ->setStyle(ConfirmationDialogObject::DANGER_STYLE)
                ->toArray()
        );
    }

    public function testTooLongTitleException(): void
    {
        self::expectException(TooLongTextException::class);

        $titleObject = self::buildTextObject();
        $titleObject->setText($this->fakerGenerator->realTextBetween(101));

        $textObject = self::buildTextObject();
        $textObject->setText($this->fakerGenerator->text(300));

        $confirm = self::buildTextObject();
        $confirm->setText($this->fakerGenerator->text(30));

        $deny = self::buildTextObject();
        $deny->setText($this->fakerGenerator->text(30));

        (new ConfirmationDialogObject())
            ->setTitle($titleObject)
            ->setText($textObject)
            ->setConfirm($confirm)
            ->setDeny($deny)
            ->toArray();
    }

    public function testTooLongTextException(): void
    {
        self::expectException(TooLongTextException::class);

        $titleObject = self::buildTextObject();
        $titleObject->setText($this->fakerGenerator->text(100));

        $textObject = self::buildTextObject();
        $textObject->setText($this->fakerGenerator->realTextBetween(301, 330));

        $confirm = self::buildTextObject();
        $confirm->setText($this->fakerGenerator->text(30));

        $deny = self::buildTextObject();
        $deny->setText($this->fakerGenerator->text(30));

        (new ConfirmationDialogObject())
            ->setTitle($titleObject)
            ->setText($textObject)
            ->setConfirm($confirm)
            ->setDeny($deny)
            ->toArray();
    }

    public function testTooLongConfirmException(): void
    {
        self::expectException(TooLongTextException::class);

        $titleObject = self::buildTextObject();
        $titleObject->setText($this->fakerGenerator->text(100));

        $textObject = self::buildTextObject();
        $textObject->setText($this->fakerGenerator->text(300));

        $confirm = self::buildTextObject();
        $confirm->setText($this->fakerGenerator->realTextBetween(31, 50));

        $deny = self::buildTextObject();
        $deny->setText($this->fakerGenerator->text(30));

        (new ConfirmationDialogObject())
            ->setTitle($titleObject)
            ->setText($textObject)
            ->setConfirm($confirm)
            ->setDeny($deny)
            ->toArray();
    }

    public function testTooLongDenyException(): void
    {
        self::expectException(TooLongTextException::class);

        $titleObject = self::buildTextObject();
        $titleObject->setText($this->fakerGenerator->text(100));

        $textObject = self::buildTextObject();
        $textObject->setText($this->fakerGenerator->text(300));

        $confirm = self::buildTextObject();
        $confirm->setText($this->fakerGenerator->text(30));

        $deny = self::buildTextObject();
        $deny->setText($this->fakerGenerator->realTextBetween(31, 50));

        (new ConfirmationDialogObject())
            ->setTitle($titleObject)
            ->setText($textObject)
            ->setConfirm($confirm)
            ->setDeny($deny)
            ->toArray();
    }
}
