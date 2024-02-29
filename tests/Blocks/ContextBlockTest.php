<?php

namespace Arouze\Tests\Blocks;

use Arouze\SlackMessageBuilder\Blocks\ContextBlock;
use Arouze\SlackMessageBuilder\Exceptions\TooMuchElementsException;
use Arouze\Tests\AbstractSlackMessageBuilderBaseTestCase;
use PHPUnit\Framework\Attributes\Group;

#[Group("ContextBlock")]
#[Group("Blocks")]
class ContextBlockTest extends AbstractSlackMessageBuilderBaseTestCase
{
    public function testContextBlockWithElements(): void
    {
        $textObject = self::buildTextObject();
        $imageObject = self::buildImageObject();

        self::assertEquals(
            [
                'type' => 'context',
                'elements' => [
                    $textObject->toArray(),
                    $imageObject->toArray()
                ]
            ],
            (new ContextBlock())
            ->addElement($textObject)
            ->addElement($imageObject)
                ->toArray()
        );
    }

    public function testContextBlockWithTooMuchElementsException(): void
    {
        self::expectException(TooMuchElementsException::class);

        $context = (new ContextBlock());

        for ($i = 0; $i < ContextBlock::MAX_ELEMENTS+1; $i++) {
            $context->addElement(self::buildTextObject());
        }

        $context->toArray();
    }
}
