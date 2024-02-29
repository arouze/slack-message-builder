<?php

namespace Arouze\SlackMessageBuilder\Common;

use Arouze\SlackMessageBuilder\Exceptions\TooLongBlockIdException;

trait BlockIdTrait
{
    protected ?string $blockId = null;
    public function setBlockId(?string $blockId): BlockIdInterface
    {
        if (strlen($blockId) > BlockIdInterface::BLOCK_ID_LENGTH) {
            throw new TooLongBlockIdException(strlen($blockId));
        }

        $this->blockId = $blockId;

        return $this;
    }

    public function handleBlockId(): BlockIdInterface
    {
        if (!is_null($this->blockId)) {
            $this->block['block_id'] = $this->blockId;
        }

        return $this;
    }

    public function addBlockIdToArray(array $block): array
    {
        if (is_null($this->blockId)) {
            return $block;
        }

        return array_merge(
            $block,
            [
                'block_id' => $this->blockId

            ]
        );
    }
}
