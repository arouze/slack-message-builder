<?php

namespace Arouze\SlackMessageBuilder\Exceptions;

use Arouze\SlackMessageBuilder\Blocks\HeaderBlock;

class TooLongHeaderTextException extends AbstractBaseException
{
    private const TOO_LONG_HEADER_TEXT_EXCEPTION_CODE = 2009;
    public function __construct(int $textLength)
    {
        parent::__construct(
            sprintf(
                "Header text is too long (%d). " .
                "Maximum length is %d (@see https://api.slack.com/reference/block-kit/blocks#header)",
                $textLength,
                HeaderBlock::MAX_TEXT_LENGTH
            ),
            self::TOO_LONG_HEADER_TEXT_EXCEPTION_CODE
        );
    }
}
