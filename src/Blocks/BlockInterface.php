<?php

namespace Arouze\SlackMessageBuilder\Blocks;

interface BlockInterface
{
    public function toArray(): array;
}
