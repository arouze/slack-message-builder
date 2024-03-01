<?php

namespace Arouze\SlackMessageBuilder\Exceptions;

class TooMuchOptionsException extends AbstractBaseException
{
    private const TOO_MUCH_OPTIONS = 2007;
    public function __construct(int $optionsCount, int $maxOptions, string $elementName)
    {
        parent::__construct(
            sprintf(
                "Element '%s' has too much options (%d). " .
                "Maximum options number is %d.",
                $elementName,
                $optionsCount,
                $maxOptions
            ),
            self::TOO_MUCH_OPTIONS
        );
    }
}
