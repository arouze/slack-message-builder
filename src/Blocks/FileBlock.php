<?php

namespace Arouze\SlackMessageBuilder\Blocks;

use Arouze\SlackMessageBuilder\Common\BlockIdInterface;
use Arouze\SlackMessageBuilder\Common\BlockIdTrait;

class FileBlock implements BlockInterface, BlockIdInterface
{
    use BlockIdTrait;

    // @see : https://api.slack.com/reference/block-kit/blocks#file
    private const FILE_TYPE = 'file';

    private const FILE_SOURCE_REMOTE = 'remote';

    private string $externalId;

    private string $source = self::FILE_SOURCE_REMOTE;

    public function toArray(): array
    {
        $block = [
            'type' => self::FILE_TYPE,
            'external_id' => $this->externalId,
            'source' => $this->source
        ];

        return $this->addBlockIdToArray($block);
    }

    public function setExternalId(string $externalId): FileBlock
    {
        $this->externalId = $externalId;

        return $this;
    }

    public function setSource(string $source): FileBlock
    {
        $this->source = $source;

        return $this;
    }
}
