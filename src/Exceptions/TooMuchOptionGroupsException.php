<?php

namespace Arouze\SlackMessageBuilder\Exceptions;

class TooMuchOptionGroupsException extends AbstractBaseException
{
    private const TOO_MUCH_OPTION_GROUPS = 2002;
    public function __construct(int $optionGroupsCount, int $maxOptions, string $elementName)
    {
        parent::__construct(
            sprintf(
                "Element '%s' has too much option groups (%d). " .
                "Maximum option groups number is %d.",
                $elementName,
                $optionGroupsCount,
                $maxOptions
            ),
            self::TOO_MUCH_OPTION_GROUPS
        );
    }
}
