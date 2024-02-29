<?php

namespace Arouze\SlackMessageBuilder\Objects;

use Arouze\SlackMessageBuilder\Exceptions\MissingFieldException;
use Arouze\SlackMessageBuilder\Exceptions\TooLongImageUrlException;
use Arouze\SlackMessageBuilder\Exceptions\TooLongTitleException;

class ImageObject implements ObjectInterface
{
    // @doc : https://api.slack.com/reference/block-kit/block-elements#image
    private const OBJECT_IMAGE_TYPE = 'image';

    public const MAXIMUM_IMAGE_URL_LENGTH = 3000;

    public const MAXIMUM_TITLE_LENGTH = 2000;
    private ?string $imageUrl = null;
    private string $altText;

    private ?TextObject $title = null;

    public function toArray(): array
    {
        $block = [
            'type' => self::OBJECT_IMAGE_TYPE,
            'alt_text' => $this->altText,
            'image_url' => $this->imageUrl
        ];

        if (!is_null($this->imageUrl)) {
            return $block;
        }

        if (!is_null($this->title)) {
            return array_merge(
                $block,
                [
                    'title' => $this->title->toArray()
                ]
            );
        }

        throw new MissingFieldException(
            self::class,
            'image_url, slack_file'
        );
    }

    public function setAltText(string $altText): self
    {
        $this->altText = $altText;

        return $this;
    }

    public function setImageUrl(?string $imageUrl): self
    {
        if (strlen($imageUrl) >= self::MAXIMUM_IMAGE_URL_LENGTH) {
            throw new TooLongImageUrlException(strlen($imageUrl));
        }

        $this->imageUrl = $imageUrl;

        return $this;
    }

    public function setTitle(?TextObject $title): self
    {
        if (strlen($title->getText()) > self::MAXIMUM_TITLE_LENGTH) {
            throw new TooLongTitleException(strlen($title->getText()));
        }

        $this->title = $title;

        return $this;
    }
}
