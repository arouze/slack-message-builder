<?php

namespace Arouze\Tests\Elements;

use Arouze\SlackMessageBuilder\Elements\WorkflowButtonElement;
use Arouze\Tests\AbstractSlackMessageBuilderBaseTestCase;
use PHPUnit\Framework\Attributes\Group;

#[Group("WorkflowButtonElement")]
#[Group("Objects")]
class WorkflowButtonElementTest extends AbstractSlackMessageBuilderBaseTestCase
{
    public function testWorkflowButtonElement(): void
    {
        $workflowUrl = $this->fakerGenerator->url();
        $textObject = self::buildTextObject();
        $workflow = self::buildWorkflowObject($workflowUrl);
        $actionId = $this->fakerGenerator->text();

        self::assertEquals(
            [
                'type' => 'workflow_button',
                'text' => $textObject->toArray(),
                'workflow' => $workflow->toArray(),
                'action_id' => $actionId
            ],
            (new WorkflowButtonElement())
                ->setText($textObject)
                ->setWorkflow($workflow)
                ->setActionId($actionId)
                ->toArray()
        );
    }

    public function testWorkflowButtonElementWithDangerStyle(): void
    {
        $workflowUrl = $this->fakerGenerator->url();
        $textObject = self::buildTextObject();
        $workflow = self::buildWorkflowObject($workflowUrl);
        $actionId = $this->fakerGenerator->text();

        self::assertEquals(
            [
                'type' => 'workflow_button',
                'text' => $textObject->toArray(),
                'workflow' => $workflow->toArray(),
                'action_id' => $actionId,
                'style' => 'danger'
            ],
            (new WorkflowButtonElement())
                ->setText($textObject)
                ->setWorkflow($workflow)
                ->setActionId($actionId)
                ->setStyle(WorkflowButtonElement::BUTTON_STYLE_DANGER)
                ->toArray()
        );
    }

    public function testWorkflowButtonElementWithAccessibilityLabel(): void
    {
        $workflowUrl = $this->fakerGenerator->url();
        $textObject = self::buildTextObject();
        $workflow = self::buildWorkflowObject($workflowUrl);
        $actionId = $this->fakerGenerator->text();
        $accessibilityLabel = $this->fakerGenerator->text(75);

        self::assertEquals(
            [
                'type' => 'workflow_button',
                'text' => $textObject->toArray(),
                'workflow' => $workflow->toArray(),
                'action_id' => $actionId,
                'accessibility_label' => $accessibilityLabel
            ],
            (new WorkflowButtonElement())
                ->setText($textObject)
                ->setWorkflow($workflow)
                ->setActionId($actionId)
                ->setAccessibilityLabel($accessibilityLabel)
                ->toArray()
        );
    }
}
