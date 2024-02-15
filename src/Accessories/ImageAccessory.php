<?php

namespace Arouze\SlackMessageBuilder\Accessories;

use Arouze\SlackMessageBuilder\Exceptions\MissingFieldException;
use Arouze\SlackMessageBuilder\Exceptions\TooLongImageUrlException;

class ImageAccessory implements AccessoryInterface
{
    private const ACCESSORY_IMAGE_TYPE = 'image';

    public const MAXIMUM_IMAGE_URL_LENGTH = 3000;
    private ?string $imageUrl = null;
    private string $altText;

    public function toArray(): array
    {
        if (!is_null($this->imageUrl)) {
            return [
                'type' => self::ACCESSORY_IMAGE_TYPE,
                'alt_text' => $this->altText,
                'image_url' => $this->imageUrl
            ];
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
}
