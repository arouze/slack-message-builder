<?php

namespace Arouze\Tests\Blocks;

use Arouze\SlackMessageBuilder\Blocks\SectionBlock;
use Arouze\SlackMessageBuilder\Exceptions\MissingFieldException;
use Arouze\SlackMessageBuilder\Exceptions\TooFieldsException;
use Arouze\SlackMessageBuilder\Exceptions\TooLongBlockIdException;
use Arouze\SlackMessageBuilder\Exceptions\TooLongBuildIdException;
use Arouze\SlackMessageBuilder\Exceptions\TooLongFieldTextException;
use Arouze\Tests\AbstractSlackMessageBuilderBaseTestCase;
use PHPUnit\Framework\Attributes\Group;

#[Group("SectionBlock")]
#[Group("Blocks")]
class SectionBlockTest extends AbstractSlackMessageBuilderBaseTestCase
{
    public function testSectionBlockWithAccessory(): void
    {
        $text = $this->fakerGenerator->text(20);
        $imageUrl = $this->fakerGenerator->imageUrl();
        $altText = $this->fakerGenerator->text(20);
        self::assertEquals(
            [
                'type' => 'section',
                'text' => [
                    'type' => 'plain_text',
                    'text' => $text
                ],
                'accessory' => [
                    'type' => 'image',
                    'image_url' => $imageUrl,
                    'alt_text' => $altText
                ]
            ],
            (new SectionBlock())
                ->setTextObject(self::buildTextObject()->setText($text))
                ->setAccessory(
                    self::buildImageObject()
                    ->setImageUrl($imageUrl)
                    ->setAltText($altText)
                )
                ->toArray()
        );
    }

    public function testSectionBlockWithFields(): void
    {
        $firstField = $this->fakerGenerator->text(20);
        $secondField = $this->fakerGenerator->text(20);
        $thirdField = $this->fakerGenerator->text(20);

        self::assertEquals(
            [
                'type' => 'section',
                'fields' => [
                    [
                        'type' => 'plain_text',
                        'text' => $firstField
                    ],
                    [
                        'type' => 'plain_text',
                        'text' => $secondField
                    ],
                    [
                        'type' => 'plain_text',
                        'text' => $thirdField
                    ]
                ]
            ],
            (new SectionBlock())
                ->addFields(self::buildTextObject()->setText($firstField))
                ->addFields(self::buildTextObject()->setText($secondField))
                ->addFields(self::buildTextObject()->setText($thirdField))
                ->toArray()
        );
    }

    public function testSectionBlockWithBlockId(): void
    {
        $blockId = $this->fakerGenerator->text(20);
        $text = $this->fakerGenerator->text(20);
        self::assertEquals(
            [
                'type' => 'section',
                'text' => [
                    'type' => 'plain_text',
                    'text' => $text
                ],
                'block_id' => $blockId
            ],
            (new SectionBlock())
                ->setTextObject(self::buildTextObject()->setText($text))
                ->setBlockId($blockId)
                ->toArray()
        );
    }

    public function testSectionBlockWithoutFieldsAndText(): void
    {
        self::expectException(MissingFieldException::class);

        (new SectionBlock())
            ->setBlockId('block_id_1')
            ->toArray();
    }

    public function testTooFieldsException(): void
    {
        self::expectException(TooFieldsException::class);

        $actions = (new SectionBlock());

        for ($i = 0; $i < SectionBlock::MAX_FIELDS+1; $i++) {
            $actions->addFields(self::buildTextObject());
        }

        $actions->toArray();
    }

    public function testTooLongFieldTextException(): void
    {
        self::expectException(TooLongFieldTextException::class);

        (new SectionBlock())
            ->addFields(
                self::buildTextObject()->setText(
                    $this->fakerGenerator->realTextBetween(2001, 3000)
                )
            )->toArray();
    }

    public function testTooLongBuildIdException(): void
    {
        self::expectException(TooLongBlockIdException::class);

        (new SectionBlock())
            ->setTextObject(self::buildTextObject())
            ->setBlockId($this->fakerGenerator->realTextBetween(256, 300))->toArray();
    }
}
