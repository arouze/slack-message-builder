<?php

namespace Arouze\SlackMessageBuilder\Exceptions;

class IncorrectMinMaxValueException extends AbstractBaseException
{
    private const INCORRECT_MIN_MAX_VALUE_EXCEPTION = 2014;
    public function __construct()
    {
        parent::__construct(
            "Max value must be greater than min value.",
            self::INCORRECT_MIN_MAX_VALUE_EXCEPTION
        );
    }
}
