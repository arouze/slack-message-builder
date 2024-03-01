<?php

namespace Arouze\SlackMessageBuilder\Elements;

interface BlockElementsInterface extends ElementInterface
{
    public function getCompatibleBlocks(): array;
}
