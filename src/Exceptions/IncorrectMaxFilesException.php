<?php

namespace Arouze\SlackMessageBuilder\Exceptions;

class IncorrectMaxFilesException extends AbstractBaseException
{
    private const INCORRECT_MAX_FILE_EXCEPTION = 2013;
    public function __construct(string $fieldName)
    {
        parent::__construct(
            sprintf(
                "Max file for field %s MUST be between 1 and 10.",
                $fieldName
            ),
            self::INCORRECT_MAX_FILE_EXCEPTION
        );
    }
}
