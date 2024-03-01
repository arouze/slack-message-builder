<?php

namespace Arouze\SlackMessageBuilder\Exceptions;

class TooMuchElementsException extends AbstractBaseException
{
    private const TOO_MUCH_ELEMENTS = 2003;
    public function __construct(int $optionsCount, int $maxElement, string $blockName)
    {
        parent::__construct(
            sprintf(
                "Block '%s' has too much elements (%d). " .
                "Maximum elements number is %d (@see https://api.slack.com/reference/block-kit/blocks#actions)",
                $blockName,
                $optionsCount,
                $maxElement
            ),
            self::TOO_MUCH_ELEMENTS
        );
    }
}
