<?php

namespace Arouze\Tests\Objects;

use Arouze\SlackMessageBuilder\Objects\TriggerObject;
use Arouze\Tests\AbstractSlackMessageBuilderBaseTestCase;
use PHPUnit\Framework\Attributes\Group;

#[Group("TriggerObject")]
#[Group("Objects")]
class TriggerObjectTest extends AbstractSlackMessageBuilderBaseTestCase
{
    public function testTriggerObject(): void
    {
        $url = $this->fakerGenerator->url();

        self::assertEquals(
            [
                'url' => $url
            ],
            (new TriggerObject())
                ->setUrl($url)
                ->toArray()
        );
    }

    public function testTriggerObjectWithCustomizableInputParameters(): void
    {
        $url = $this->fakerGenerator->url();
        $dialogObject = self::buildConfirmDialogObjectElement();

        self::assertEquals(
            [
                'url' => $url,
                'customizable_input_parameters' => [
                    $dialogObject->toArray()
                ]
            ],
            (new TriggerObject())
                ->setUrl($url)
                ->addCustomizableInputParameters($dialogObject)
                ->toArray()
        );
    }
}
