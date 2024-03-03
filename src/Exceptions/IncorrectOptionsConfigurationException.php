<?php

namespace Arouze\SlackMessageBuilder\Exceptions;

class IncorrectOptionsConfigurationException extends AbstractBaseException
{
    private const MISSING_FIELD_EXCEPTION = 2006;
    public function __construct(string $objectClass)
    {
        parent::__construct(
            sprintf(
                "%s Element cannot have options AND option groups.",
                $objectClass
            ),
            self::MISSING_FIELD_EXCEPTION
        );
    }
}
