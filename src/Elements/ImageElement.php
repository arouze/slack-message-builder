<?php

namespace Arouze\SlackMessageBuilder\Elements;

use Arouze\SlackMessageBuilder\Blocks\ContextBlock;
use Arouze\SlackMessageBuilder\Blocks\SectionBlock;
use Arouze\SlackMessageBuilder\Exceptions\MissingFieldException;
use Arouze\SlackMessageBuilder\Exceptions\TooLongTextException;
use Arouze\SlackMessageBuilder\Objects\SlackFileObject;
use Arouze\SlackMessageBuilder\Objects\TextObject;

class ImageElement implements BlockElementsInterface
{
    // @doc : https://api.slack.com/reference/block-kit/block-elements#image
    private const IMAGE_TYPE = 'image';

    public const MAXIMUM_IMAGE_URL_LENGTH = 3000;

    public const MAXIMUM_TITLE_LENGTH = 2000;

    private array $block = [
        'type' => self::IMAGE_TYPE
    ];
    private ?string $imageUrl = null;
    private string $altText;

    private ?TextObject $title = null;

    private ?SlackFileObject $slackFile = null;

    public function setAltText(string $altText): self
    {
        $this->altText = $altText;

        return $this;
    }

    public function setImageUrl(?string $imageUrl): self
    {
        $this->imageUrl = $imageUrl;

        return $this;
    }

    public function setTitle(?TextObject $title): self
    {
        $this->title = $title;

        return $this;
    }

    public function setSlackFile(?SlackFileObject $slackFile): ImageElement
    {
        $this->slackFile = $slackFile;

        return $this;
    }

    private function validate(): void
    {
        if (!is_null($this->imageUrl) && strlen($this->imageUrl) >= self::MAXIMUM_IMAGE_URL_LENGTH) {
            throw new TooLongTextException(
                strlen($this->imageUrl),
                self::MAXIMUM_IMAGE_URL_LENGTH,
                'url'
            );
        }

        if (!is_null($this->title) && strlen($this->title->getText()) > self::MAXIMUM_TITLE_LENGTH) {
            throw new TooLongTextException(
                strlen($this->title->getText()),
                self::MAXIMUM_TITLE_LENGTH,
                'title'
            );
        }

        if (is_null($this->imageUrl) && is_null($this->slackFile)) {
            throw new MissingFieldException(
                self::class,
                'image_url, slack_file'
            );
        }
    }
    private function handleTitle(): self
    {
        if (!is_null($this->title)) {
            $this->block['title'] = $this->title->toArray();
        }

        return $this;
    }

    private function handleImageUrl(): self
    {
        if (!is_null($this->imageUrl)) {
            $this->block['image_url'] = $this->imageUrl;
        }

        return $this;
    }

    private function handleSlackFile(): self
    {
        if (!is_null($this->slackFile)) {
            $this->block['slack_file'] = $this->slackFile->toArray();
        }

        return $this;
    }

    public function toArray(): array
    {
        $this->validate();

        $this
            ->handleTitle()
            ->handleImageUrl()
            ->handleSlackFile();

        $this->block['alt_text'] = $this->altText;

        return $this->block;
    }

    public function getCompatibleBlocks(): array
    {
        return [
            SectionBlock::class,
            ContextBlock::class
        ];
    }
}
