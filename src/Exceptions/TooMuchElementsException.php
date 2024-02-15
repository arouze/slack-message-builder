<?php

namespace Arouze\SlackMessageBuilder\Exceptions;

use Arouze\SlackMessageBuilder\Blocks\ActionBlock;

class TooMuchElementsException extends AbstractBaseException
{
    private const TOO_MUCH_ELEMENTS = 2003;
    public function __construct(int $elementsCount)
    {
        parent::__construct(
            sprintf(
                "Block has too much elements (%d). " .
                "Maximum elements number is %d (@see https://api.slack.com/reference/block-kit/blocks#actions)",
                $elementsCount,
                ActionBlock::MAX_ELEMENTS
            ),
            self::TOO_MUCH_ELEMENTS
        );
    }
}
