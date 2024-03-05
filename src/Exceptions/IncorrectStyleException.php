<?php

namespace Arouze\SlackMessageBuilder\Exceptions;

class IncorrectStyleException extends AbstractBaseException
{
    private const INCORRECT_STYLE_EXCEPTION = 2016;
    public function __construct(string $elementName, array $availableStyle)
    {
        parent::__construct(
            sprintf(
                "Incorrect Style for element %s, available style : %s.",
                $elementName,
                implode(', ', $availableStyle)
            ),
            self::INCORRECT_STYLE_EXCEPTION
        );
    }
}
