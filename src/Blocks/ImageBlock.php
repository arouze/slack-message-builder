<?php

namespace Arouze\SlackMessageBuilder\Blocks;

use Arouze\SlackMessageBuilder\Common\BlockIdInterface;
use Arouze\SlackMessageBuilder\Common\BlockIdTrait;
use Arouze\SlackMessageBuilder\Exceptions\MissingFieldException;
use Arouze\SlackMessageBuilder\Exceptions\TooLongTextException;
use Arouze\SlackMessageBuilder\Objects\SlackFileObject;
use Arouze\SlackMessageBuilder\Objects\TextObject;

class ImageBlock implements BlockInterface, BlockIdInterface
{
    use BlockIdTrait;

    // @doc : https://api.slack.com/reference/block-kit/blocks#image
    private const IMAGE_TYPE = 'image';

    private array $block = [
        'type' => self::IMAGE_TYPE
    ];

    private const MAX_ALT_TEXT_LENGTH = 2000;

    private const MAX_TITLE_LENGTH = 2000;

    private string $altText;

    private ?string $imageUrl = null;

    private ?SlackFileObject $slackFile = null;

    private ?TextObject $title = null;

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

    private function validate(): void
    {
        if (strlen($this->altText) > self::MAX_ALT_TEXT_LENGTH) {
            throw new TooLongTextException(strlen($this->altText), self::MAX_ALT_TEXT_LENGTH);
        }

        if (is_null($this->imageUrl) && is_null($this->slackFile)) {
            throw new MissingFieldException(self::class, 'image_url, slack_file');
        }

        if (!is_null($this->title) && strlen($this->title->getText()) > self::MAX_TITLE_LENGTH) {
            throw new TooLongTextException(strlen($this->title->getText()), self::MAX_TITLE_LENGTH);
        }
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

    private function handleTitle(): self
    {
        if (!is_null($this->title)) {
            $this->block['title'] = $this->title->toArray();
        }

        return $this;
    }

    public function toArray(): array
    {
        $this->validate();

        $this
            ->handleImageUrl()
            ->handleSlackFile()
            ->handleTitle();

        $this->block['alt_text'] = $this->altText;

        return $this->addBlockIdToArray($this->block);
    }
}
