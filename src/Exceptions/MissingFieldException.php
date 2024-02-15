<?php

namespace Arouze\SlackMessageBuilder\Exceptions;

class MissingFieldException extends AbstractBaseException
{
    private const MISSING_FIELD_EXCEPTION = 2000;
    public function __construct(string $objectClass, $fields)
    {
        parent::__construct(
            sprintf(
                "Cannot build %s object. A field is missing (%s).",
                $objectClass,
                $fields
            ),
            self::MISSING_FIELD_EXCEPTION
        );
    }
}
