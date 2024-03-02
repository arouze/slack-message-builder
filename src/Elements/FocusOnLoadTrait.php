<?php

namespace Arouze\SlackMessageBuilder\Elements;

trait FocusOnLoadTrait
{
    private bool $focusOnLoad = false;

    public function focusOnLoad(): self
    {
        $this->focusOnLoad = true;

        return $this;
    }

    private function handleFocusOnLoad(): self
    {
        if ($this->focusOnLoad === true) {
            $this->block['focus_on_load'] = true;
        }

        return $this;
    }
}
