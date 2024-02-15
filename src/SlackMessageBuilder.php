<?php

namespace Arouze\SlackMessageBuilder;

use Arouze\SlackMessageBuilder\Blocks\BlockInterface;

class SlackMessageBuilder
{
    // @see https://app.slack.com/block-kit-builder/ For examples
    private array $blocks = [];

    public function addBlock(BlockInterface $block): self
    {
        $this->blocks[] = $block;

        return $this;
    }

    public function render(): array
    {
        $render = [];
        foreach ($this->blocks as $block) {
            $render[] = $block->toArray();
        }

        return $render;
    }
}
