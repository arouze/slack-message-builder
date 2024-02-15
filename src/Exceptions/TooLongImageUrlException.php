<?php

namespace Arouze\SlackMessageBuilder\Exceptions;

use Arouze\SlackMessageBuilder\Accessories\ImageAccessory;

class TooLongImageUrlException extends AbstractBaseException
{
    private const TOO_LONG_IMAGE_URL_EXCEPTION_CODE = 2002;
    public function __construct(int $textLength)
    {
        parent::__construct(
            sprintf(
                "Image url is too long (%d). " .
                "Maximum length is %d (@see https://api.slack.com/reference/block-kit/block-elements#image)",
                $textLength,
                ImageAccessory::MAXIMUM_IMAGE_URL_LENGTH
            ),
            self::TOO_LONG_IMAGE_URL_EXCEPTION_CODE
        );
    }
}
