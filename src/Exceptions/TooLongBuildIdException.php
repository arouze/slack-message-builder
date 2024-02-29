<?php

namespace Arouze\SlackMessageBuilder\Exceptions;

use Arouze\SlackMessageBuilder\Blocks\SectionBlock;

class TooLongBuildIdException extends AbstractBaseException
{
    private const TOO_LONG_BUILD_ID_EXCEPTION_CODE = 2005;

    public function __construct(int $textLength)
    {
        parent::__construct(
            sprintf(
                "BuildId text is too long (%d). " .
                "Maximum length is %d (@see https://api.slack.com/reference/block-kit/blocks#section_fields)",
                $textLength,
                SectionBlock::MAXIMUM_BUILD_ID_LENGTH
            ),
            self::TOO_LONG_BUILD_ID_EXCEPTION_CODE
        );
    }
}
