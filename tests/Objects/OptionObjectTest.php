<?php

namespace Arouze\Tests\Objects;

use Arouze\SlackMessageBuilder\Exceptions\TooLongTextException;
use Arouze\SlackMessageBuilder\Objects\OptionObject;
use Arouze\Tests\AbstractSlackMessageBuilderBaseTestCase;
use PHPUnit\Framework\Attributes\Group;

#[Group("OptionObject")]
#[Group("Objects")]
class OptionObjectTest extends AbstractSlackMessageBuilderBaseTestCase
{
    public function testOptionObject(): void
    {
        $text = self::buildTextObject();
        $value = $this->fakerGenerator->text(75);

        self::assertEquals(
            [
                'text' => $text->toArray(),
                'value' => $value
            ],
            (new OptionObject())
                ->setText($text)
                ->setValue($value)
                ->toArray()
        );
    }

    public function testOptionObjectWithDescription(): void
    {
        $text = self::buildTextObject();
        $value = $this->fakerGenerator->text(75);
        $description = self::buildTextObject();

        self::assertEquals(
            [
                'text' => $text->toArray(),
                'value' => $value,
                'description' => $description->toArray()
            ],
            (new OptionObject())
                ->setText($text)
                ->setValue($value)
                ->setDescription($description)
                ->toArray()
        );
    }

    public function testOptionObjectWithUrl(): void
    {
        $text = self::buildTextObject();
        $value = $this->fakerGenerator->text(75);
        $url = $this->fakerGenerator->url();

        self::assertEquals(
            [
                'text' => $text->toArray(),
                'value' => $value,
                'url' => $url
            ],
            (new OptionObject())
                ->setText($text)
                ->setValue($value)
                ->setUrl($url)
                ->toArray()
        );
    }

    public function testTooLongTextException(): void
    {
        self::expectException(TooLongTextException::class);
        $text = self::buildTextObject();
        $text->setText($this->fakerGenerator->realTextBetween(76));

        $value = $this->fakerGenerator->text(75);

        (new OptionObject())
            ->setText($text)
            ->setValue($value)
            ->toArray();
    }

    public function testTooLongValueException(): void
    {
        self::expectException(TooLongTextException::class);
        $text = self::buildTextObject();
        $value = $this->fakerGenerator->realTextBetween(76);

        (new OptionObject())
            ->setText($text)
            ->setValue($value)
            ->toArray();
    }

    public function testTooLongDescriptionException(): void
    {
        self::expectException(TooLongTextException::class);
        $text = self::buildTextObject();
        $value = $this->fakerGenerator->text(75);
        $description = self::buildTextObject();
        $description->setText($this->fakerGenerator->realTextBetween(76));

        (new OptionObject())
            ->setText($text)
            ->setValue($value)
            ->setDescription($description)
            ->toArray();
    }

    public function testTooLongUrlException(): void
    {
        self::expectException(TooLongTextException::class);
        $text = self::buildTextObject();
        $value = $this->fakerGenerator->text(75);
        $url = $this->fakerGenerator->realTextBetween(3001, 3300);

        (new OptionObject())
            ->setText($text)
            ->setValue($value)
            ->setUrl($url)
            ->toArray();
    }
}
