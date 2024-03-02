<?php

namespace Arouze\Tests\Elements;

use Arouze\SlackMessageBuilder\Elements\FileInputElement;
use Arouze\SlackMessageBuilder\Exceptions\IncorrectMaxFilesException;
use Arouze\Tests\AbstractSlackMessageBuilderBaseTestCase;
use PHPUnit\Framework\Attributes\Group;

#[Group("FileInputElement")]
#[Group("Elements")]
class FileInputElementTest extends AbstractSlackMessageBuilderBaseTestCase
{
    public function testFileInputElement(): void
    {
        self::assertEquals(
            [
                'type' => 'file_input'
            ],
            (new FileInputElement())
                ->toArray()
        );
    }

    public function testFileInputElementWithFileTypes(): void
    {
        self::assertEquals(
            [
                'type' => 'file_input',
                'filetypes' => [
                    'php'
                ]
            ],
            (new FileInputElement())
                ->setFileTypes(['php'])
                ->toArray()
        );
    }

    public function testFileInputElementWithMaxFiles(): void
    {
        self::assertEquals(
            [
                'type' => 'file_input',
                'max_files' => 7
            ],
            (new FileInputElement())
                ->setMaxFiles(7)
                ->toArray()
        );
    }

    public function testFileInputElementWithTooLargeMaxFileException(): void
    {
        self::expectException(IncorrectMaxFilesException::class);

        (new FileInputElement())
            ->setMaxFiles(11)
            ->toArray();

    }

    public function testFileInputElementWithTooLowMaxFileException(): void
    {
        self::expectException(IncorrectMaxFilesException::class);

        (new FileInputElement())
            ->setMaxFiles(0)
            ->toArray();

    }
}
