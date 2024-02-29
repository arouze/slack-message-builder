<?php

namespace Arouze\Tests\Blocks;

use Arouze\SlackMessageBuilder\Blocks\FileBlock;
use Arouze\Tests\AbstractSlackMessageBuilderBaseTestCase;
use PHPUnit\Framework\Attributes\Group;

#[Group("FileBlock")]
#[Group("Blocks")]
class FileBlockTest extends AbstractSlackMessageBuilderBaseTestCase
{
    public function testFileBlockWithElements(): void
    {
        $source = 'remote';
        $externalId = 'ABCD1';

        self::assertEquals(
            [
                'type' => 'file',
                'source' => $source,
                'external_id' => $externalId
            ],
            (new FileBlock())
            ->setSource($source)
            ->setExternalId($externalId)
            ->toArray()
        );
    }
}
