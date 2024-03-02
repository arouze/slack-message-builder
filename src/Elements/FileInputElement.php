<?php

namespace Arouze\SlackMessageBuilder\Elements;

use Arouze\SlackMessageBuilder\Blocks\InputBlock;
use Arouze\SlackMessageBuilder\Common\ActionIdTrait;
use Arouze\SlackMessageBuilder\Exceptions\IncorrectMaxFilesException;

class FileInputElement implements BlockElementsInterface
{
    use ActionIdTrait;

    // @doc : https://api.slack.com/reference/block-kit/block-elements#file_input

    private const FILE_INPUT_TYPE = 'file_input';

    private const MAXIMUM_MAX_FILE = 10;

    private const MINIMUM_MAX_FILE = 1;

    private array $block = [
        'type' => self::FILE_INPUT_TYPE
    ];

    // @doc : https://api.slack.com/types/file#types
    private ?array $fileTypes = null;

    private ?int $maxFiles = null;

    public function setFileTypes(?array $fileTypes): FileInputElement
    {
        $this->fileTypes = $fileTypes;

        return $this;
    }
    public function setMaxFiles(?int $maxFiles): FileInputElement
    {
        $this->maxFiles = $maxFiles;

        return $this;
    }

    private function handleFileTypes(): self
    {
        if (!is_null($this->fileTypes)) {
            $this->block['filetypes'] = $this->fileTypes;
        }

        return $this;
    }

    private function handleMaxFiles(): self
    {
        if (!is_null($this->maxFiles)) {
            $this->block['max_files'] = $this->maxFiles;
        }

        return $this;
    }

    private function validate(): void
    {
        if (
            !is_null($this->maxFiles) &&
            ($this->maxFiles < self::MINIMUM_MAX_FILE || $this->maxFiles > self::MAXIMUM_MAX_FILE)
        ) {
            throw new IncorrectMaxFilesException('max_files');
        }
    }

    public function toArray(): array
    {
        $this->validate();

        $this
            ->handleFileTypes()
            ->handleMaxFiles()
        ;

        return $this->block;
    }

    public function getCompatibleBlocks(): array
    {
        return [
            InputBlock::class
        ];
    }
}
