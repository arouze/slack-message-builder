<?php

namespace Arouze\SlackMessageBuilder\Exceptions;

class TooShortTextException extends AbstractBaseException
{
    private const TOO_SHORT_TEXT = 2001;

    public function __construct(int $titleLength, int $minLength, string $fieldName)
    {
        parent::__construct(
            sprintf(
                "Text field '%s' is too short (%d). " .
                "Minimal length is %d",
                $titleLength,
                $fieldName,
                $minLength
            ),
            self::TOO_SHORT_TEXT
        );
    }
}
