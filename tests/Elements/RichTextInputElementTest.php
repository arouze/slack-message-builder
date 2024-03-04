<?php

namespace Arouze\Tests\Elements;

use Arouze\SlackMessageBuilder\Elements\RichTextInputElement;
use Arouze\Tests\AbstractSlackMessageBuilderBaseTestCase;
use PHPUnit\Framework\Attributes\Group;

#[Group("RichTextInputElement")]
#[Group("Elements")]
class RichTextInputElementTest extends AbstractSlackMessageBuilderBaseTestCase
{
    public function testRichTextInputElement(): void
    {
        $actionId = $this->fakerGenerator->text();
        self::assertEquals(
            [
                'type' => 'rich_text_input',
                'action_id' => $actionId
            ],
            (new RichTextInputElement())
                ->setActionId($actionId)
                ->toArray()
        );
    }

    public function testRichTextInputElementWithInitialValue(): void
    {
        $actionId = $this->fakerGenerator->text();
        $initialValue = self::buildRichTextSectionElement();

        self::assertEquals(
            [
                'type' => 'rich_text_input',
                'action_id' => $actionId,
                'initial_value' => $initialValue->toArray()
            ],
            (new RichTextInputElement())
                ->setActionId($actionId)
                ->setInitialValue($initialValue)
                ->toArray()
        );
    }
}
