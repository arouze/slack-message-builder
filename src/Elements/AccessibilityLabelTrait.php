<?php

namespace Arouze\SlackMessageBuilder\Elements;

use Arouze\SlackMessageBuilder\Exceptions\TooLongTextException;

trait AccessibilityLabelTrait
{
    private ?string $accessibilityLabel = null;
    public function setAccessibilityLabel(?string $accessibilityLabel): self
    {
        $this->accessibilityLabel = $accessibilityLabel;

        return $this;
    }
    private function validateAccessibilityLabel(int $maxAccessibilityLabelLength): void
    {
        if (
            !is_null($this->accessibilityLabel) &&
            strlen($this->accessibilityLabel) > $maxAccessibilityLabelLength
        ) {
            throw new TooLongTextException(
                strlen($this->accessibilityLabel),
                $maxAccessibilityLabelLength,
                'accessibility_label'
            );
        }
    }
    private function handleAccessibilityLabel(): self
    {
        if (!is_null($this->accessibilityLabel)) {
            $this->block['accessibility_label'] = $this->accessibilityLabel;
        }

        return $this;
    }
}
