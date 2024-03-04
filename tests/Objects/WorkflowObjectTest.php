<?php

namespace Arouze\Tests\Objects;

use Arouze\SlackMessageBuilder\Objects\WorkflowObject;
use Arouze\Tests\AbstractSlackMessageBuilderBaseTestCase;
use PHPUnit\Framework\Attributes\Group;

#[Group("WorkflowObject")]
#[Group("Objects")]
class WorkflowObjectTest extends AbstractSlackMessageBuilderBaseTestCase
{
    public function testWorkflowObject(): void
    {
        $url = $this->fakerGenerator->url();
        $trigger = self::buildTriggerObject($url);

        self::assertEquals(
            [
                'trigger' => $trigger->toArray()
            ],
            (new WorkflowObject())->setTrigger($trigger)->toArray()
    );
    }
}
