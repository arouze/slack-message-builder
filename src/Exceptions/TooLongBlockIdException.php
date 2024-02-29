<?php

namespace Arouze\SlackMessageBuilder\Exceptions;

use Arouze\SlackMessageBuilder\Common\BlockIdInterface;

class TooLongBlockIdException extends AbstractBaseException
{
    private const TOO_LONG_BLOCK_ID_EXCEPTION_CODE = 2010;
    public function __construct(int $textLength)
    {
        parent::__construct(
            sprintf(
                "BlockId is too long (%d). " .
                "Maximum length is %d (@see https://api.slack.com/reference/block-kit/blocks#header)",
                $textLength,
                BlockIdInterface::BLOCK_ID_LENGTH
            ),
            self::TOO_LONG_BLOCK_ID_EXCEPTION_CODE
        );
    }
}
