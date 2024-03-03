<?php

namespace Arouze\SlackMessageBuilder\Exceptions;

class IncorrectFieldLengthException extends AbstractBaseException
{
    private const INCORRECT_FIELD_LENGTH_EXCEPTION = 2015;

    public function __construct(string $field, int $minValue, int $maxValue)
    {
        parent::__construct(
            sprintf(
                "%s field must have a value between %d and %d.",
                $field,
                $minValue,
                $maxValue
            ),
            self::INCORRECT_FIELD_LENGTH_EXCEPTION
        );
    }
}
