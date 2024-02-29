<?php

namespace Arouze\SlackMessageBuilder\Common;

interface BlockIdInterface
{
    public const BLOCK_ID_LENGTH = 255;

    public function setBlockId(?string $blockId): self;

    public function handleBlockId(): self;
}
