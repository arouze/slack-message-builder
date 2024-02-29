<?php

namespace Arouze\SlackMessageBuilder\Exceptions;

class TooLongTextException extends AbstractBaseException
{
    private const TOO_LONG_TEXT = 2011;

    public function __construct(int $titleLength, int $maxLength)
    {
        parent::__construct(
            sprintf(
                "Text is too long (%d). " .
                "Maximum length is %d (@see https://api.slack.com/reference/block-kit/block-elements#image)",
                $titleLength,
                $maxLength
            ),
            self::TOO_LONG_TEXT
        );
    }
}
