<?php

namespace Arouze\SlackMessageBuilder\Exceptions;

use Arouze\SlackMessageBuilder\Objects\ImageObject;

class TooLongFieldTextException extends AbstractBaseException
{
    private const TOO_LONG_IMAGE_URL_EXCEPTION_CODE = 2008;
    public function __construct(int $textLength)
    {
        parent::__construct(
            sprintf(
                "Fields text is too long (%d). " .
                "Maximum length is %d (@see https://api.slack.com/reference/block-kit/blocks#section_fields)",
                $textLength,
                ImageObject::MAXIMUM_IMAGE_URL_LENGTH
            ),
            self::TOO_LONG_IMAGE_URL_EXCEPTION_CODE
        );
    }
}
