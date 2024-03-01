<?php

namespace Arouze\SlackMessageBuilder\Blocks;

use Arouze\SlackMessageBuilder\Common\BlockIdInterface;
use Arouze\SlackMessageBuilder\Common\BlockIdTrait;
use Arouze\SlackMessageBuilder\Exceptions\MissingFieldException;
use Arouze\SlackMessageBuilder\Exceptions\TooLongTextException;
use Arouze\SlackMessageBuilder\Objects\TextObject;

class VideoBlock implements BlockInterface, BlockIdInterface
{
    use BlockIdTrait;

    // @doc : https://api.slack.com/reference/block-kit/blocks#video

    private const VIDEO_TYPE = 'video';

    private const MAX_AUTHOR_NAME_LENGTH = 50;

    private const MAX_DESCRIPTION_LENGTH = 200;

    private const MAX_TITLE_LENGTH = 200;

    private array $block = [
        'type' => self::VIDEO_TYPE
    ];

    private string $altText;

    private ?string $authorName = null;

    private ?TextObject $description = null;

    private ?string $providerIconUrl = null;

    private ?string $providerName = null;

    private TextObject $title;

    private ?string $titleUrl = null;

    private string $thumbnailUrl;

    private string $videoUrl;

    public function setAltText(string $altText): self
    {
        $this->altText = $altText;

        return $this;
    }

    public function setAuthorName(?string $authorName): self
    {
        $this->authorName = $authorName;

        return $this;
    }

    public function setDescription(?TextObject $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function setProviderIconUrl(?string $providerIconUrl): self
    {
        $this->providerIconUrl = $providerIconUrl;

        return $this;
    }

    public function setProviderName(?string $providerName): self
    {
        $this->providerName = $providerName;

        return $this;
    }

    public function setTitle(TextObject $title): self
    {
        $this->title = $title;

        return $this;
    }

    public function setTitleUrl(?string $titleUrl): self
    {
        $this->titleUrl = $titleUrl;

        return $this;
    }

    public function setThumbnailUrl(string $thumbnailUrl): self
    {
        $this->thumbnailUrl = $thumbnailUrl;

        return $this;
    }

    public function setVideoUrl(string $videoUrl): self
    {
        $this->videoUrl = $videoUrl;

        return $this;
    }

    private function validate(): void
    {
        if (!isset($this->altText)) {
            throw new MissingFieldException(self::class, 'alt_text');
        }

        if (!is_null($this->authorName) && strlen($this->authorName) > self::MAX_AUTHOR_NAME_LENGTH) {
            throw new TooLongTextException(strlen($this->authorName), self::MAX_AUTHOR_NAME_LENGTH);
        }

        if (!is_null($this->description) && strlen($this->description->getText()) > self::MAX_DESCRIPTION_LENGTH) {
            throw new TooLongTextException(
                strlen($this->description->getText()),
                self::MAX_DESCRIPTION_LENGTH
            );
        }

        $this->validateTitle();

        if (!isset($this->thumbnailUrl)) {
            throw new MissingFieldException(self::class, 'thumbnail_url');
        }

        if (!isset($this->videoUrl)) {
            throw new MissingFieldException(self::class, 'video_url');
        }
    }

    private function validateTitle(): void
    {
        if (!isset($this->title)) {
            throw new MissingFieldException(self::class, 'title');
        }

        if (strlen($this->title->getText()) > self::MAX_TITLE_LENGTH) {
            throw new TooLongTextException(strlen($this->title->getText()), self::MAX_TITLE_LENGTH);
        }
    }

    private function handleAuthorName(): self
    {
        if (!is_null($this->authorName)) {
            $this->block['author_name'] = $this->authorName;
        }

        return $this;
    }

    private function handleDescription(): self
    {
        if (!is_null($this->description)) {
            $this->block['description'] = $this->description->toArray();
        }

        return $this;
    }

    private function handleProviderIconUrl(): self
    {
        if (!is_null($this->providerIconUrl)) {
            $this->block['provider_icon_url'] = $this->providerIconUrl;
        }

        return $this;
    }

    private function handleProviderName(): self
    {
        if (!is_null($this->providerName)) {
            $this->block['provider_name'] = $this->providerName;
        }

        return $this;
    }

    private function handleTitleUrl(): self
    {
        if (!is_null($this->titleUrl)) {
            $this->block['title_url'] = $this->titleUrl;
        }

        return $this;
    }

    public function toArray(): array
    {
        $this->validate();

        $this
            ->handleAuthorName()
            ->handleDescription()
            ->handleProviderIconUrl()
            ->handleProviderName()
            ->handleTitleUrl()
            ;

        $this->block['alt_text'] = $this->altText;

        $this->block['title'] = $this->title->toArray();

        $this->block['thumbnail_url'] = $this->thumbnailUrl;

        $this->block['video_url'] = $this->videoUrl;

        return $this->addBlockIdToArray($this->block);
    }
}
