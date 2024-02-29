<?php

namespace Arouze\SlackMessageBuilder\Exceptions;

use Arouze\SlackMessageBuilder\Blocks\SectionBlock;

class TooFieldsException extends AbstractBaseException
{
    private const TOO_MUCH_FIELDS = 2004;
    public function __construct(int $fieldsCount)
    {
        parent::__construct(
            sprintf(
                "Block has too much fields (%d). " .
                "Maximum fields number is %d (@see https://api.slack.com/reference/block-kit/blocks#section_fields)",
                $fieldsCount,
                SectionBlock::MAX_FIELDS
            ),
            self::TOO_MUCH_FIELDS
        );
    }
}
