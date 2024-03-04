<?php

namespace Arouze\SlackMessageBuilder\Elements;

use Arouze\SlackMessageBuilder\Blocks\ActionBlock;
use Arouze\SlackMessageBuilder\Blocks\SectionBlock;
use Arouze\SlackMessageBuilder\Common\ActionIdTrait;
use Arouze\SlackMessageBuilder\Exceptions\TooLongTextException;
use Arouze\SlackMessageBuilder\Objects\TextObject;
use Arouze\SlackMessageBuilder\Objects\WorkflowObject;

class WorkflowButtonElement implements BlockElementsInterface
{
    use AccessibilityLabelTrait;
    use ActionIdTrait;
    use StyleTrait;

    // @doc : https://api.slack.com/reference/block-kit/block-elements#workflow_button

    private const WORKFLOW_BUTTON_TYPE = 'workflow_button';
    private const MAX_TEXT_LENGTH = 75;

    private const MAX_ACCESSIBILITY_LABEL_LENGTH = 75;

    private array $block = [
        'type' => self::WORKFLOW_BUTTON_TYPE
    ];

    private TextObject $text;

    private WorkflowObject $workflow;


    public function setText(TextObject $text): WorkflowButtonElement
    {
        $this->text = $text;

        return $this;
    }

    public function setWorkflow(WorkflowObject $workflow): WorkflowButtonElement
    {
        $this->workflow = $workflow;

        return $this;
    }
    private function handleText(): self
    {
        $this->block['text'] = $this->text->toArray();

        return $this;
    }

    private function handleWorkflow(): self
    {
        $this->block['workflow'] = $this->workflow->toArray();

        return $this;
    }

    private function validate(): void
    {
        if (strlen($this->text->getText()) > self::MAX_TEXT_LENGTH) {
            throw new TooLongTextException(strlen($this->text->getText()), self::MAX_TEXT_LENGTH, 'text');
        }

        $this->validateAccessibilityLabel(self::MAX_ACCESSIBILITY_LABEL_LENGTH);
    }

    public function toArray(): array
    {
        $this->validate();

        $this
            ->handleText()
            ->handleWorkflow()
            ->handleActionId()
            ->handleStyle()
            ->handleAccessibilityLabel();

        return $this->block;
    }

    public function getCompatibleBlocks(): array
    {
        return [
            SectionBlock::class,
            ActionBlock::class
        ];
    }
}
