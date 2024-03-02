<?php

namespace Arouze\SlackMessageBuilder\Exceptions;

class IncorrectTimeStampException extends AbstractBaseException
{
    private const MISSING_FIELD_EXCEPTION = 2009;
    public function __construct(string $fieldName)
    {
        parent::__construct(
            sprintf(
                "Incorrect TimeStamp format for field %s, it MUST be a 10 digits format.",
                $fieldName
            ),
            self::MISSING_FIELD_EXCEPTION
        );
    }
}
