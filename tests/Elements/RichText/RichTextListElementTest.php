<?php

namespace Arouze\Tests\Elements\RichText;

use Arouze\SlackMessageBuilder\Elements\RichText\RichTextListElement;
use Arouze\Tests\AbstractSlackMessageBuilderBaseTestCase;
use PHPUnit\Framework\Attributes\Group;

#[Group("RichTextListElement")]
#[Group("RichText")]
#[Group("Elements")]
class RichTextListElementTest extends AbstractSlackMessageBuilderBaseTestCase
{
    public function testRichTextSectionElement(): void
    {
        $richTextSection = self::buildRichTextSectionElement();

        self::assertEquals(
            [
                'type' => 'rich_text_list',
                'elements' => [
                    $richTextSection->toArray()
                ],
                'style' => 'bullet'
            ],
            (new RichTextListElement())
                ->addElement(
                    $richTextSection
                )
                ->toArray()
        );
    }

    public function testRichTextSectionElementWithOrderedStyle(): void
    {
        $richTextSection = self::buildRichTextSectionElement();

        self::assertEquals(
            [
                'type' => 'rich_text_list',
                'elements' => [
                    $richTextSection->toArray()
                ],
                'style' => 'ordered'
            ],
            (new RichTextListElement())
                ->addElement(
                    $richTextSection
                )
                ->setStyle(RichTextListElement::STYLE_ORDERED)
                ->toArray()
        );
    }

    public function testRichTextSectionElementWithIndent(): void
    {
        $richTextSection = self::buildRichTextSectionElement();

        self::assertEquals(
            [
                'type' => 'rich_text_list',
                'elements' => [
                    $richTextSection->toArray()
                ],
                'style' => 'bullet',
                'indent' => 10
            ],
            (new RichTextListElement())
                ->addElement(
                    $richTextSection
                )
                ->setIndent(10)
                ->toArray()
        );
    }

    public function testRichTextSectionElementWithOffset(): void
    {
        $richTextSection = self::buildRichTextSectionElement();

        self::assertEquals(
            [
                'type' => 'rich_text_list',
                'elements' => [
                    $richTextSection->toArray()
                ],
                'style' => 'bullet',
                'offset' => 10
            ],
            (new RichTextListElement())
                ->addElement(
                    $richTextSection
                )
                ->setOffset(10)
                ->toArray()
        );
    }

    public function testRichTextSectionElementWithBorder(): void
    {
        $richTextSection = self::buildRichTextSectionElement();

        self::assertEquals(
            [
                'type' => 'rich_text_list',
                'elements' => [
                    $richTextSection->toArray()
                ],
                'style' => 'bullet',
                'border' => 10
            ],
            (new RichTextListElement())
                ->addElement(
                    $richTextSection
                )
                ->setBorder(10)
                ->toArray()
        );
    }
}
