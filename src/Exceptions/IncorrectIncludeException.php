<?php

namespace Arouze\SlackMessageBuilder\Exceptions;

class IncorrectIncludeException extends AbstractBaseException
{
    private const INCORRECT_INCLUDE_EXCEPTION = 2017;
    public function __construct(string $elementName, array $availableInclude)
    {
        parent::__construct(
            sprintf(
                "Incorrect Include for element %s, available include : %s.",
                $elementName,
                implode(', ', $availableInclude)
            ),
            self::INCORRECT_INCLUDE_EXCEPTION
        );
    }
}
