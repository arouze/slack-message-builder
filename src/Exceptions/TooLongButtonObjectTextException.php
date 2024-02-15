<?php

namespace Arouze\SlackMessageBuilder\Exceptions;

use Arouze\SlackMessageBuilder\Objects\ButtonTextObject;

class TooLongButtonObjectTextException extends AbstractBaseException
{
    private const TOO_LONG_BUTTON_OBJECT_TEXT_EXCEPTION_CODE = 2007;
    public function __construct(int $textLength)
    {
        parent::__construct(
            sprintf(
                "Button text message is too long (%d). " .
                "Maximum length is %d (@see https://api.slack.com/reference/block-kit/block-elements#button)",
                $textLength,
                ButtonTextObject::MAXIMUM_TEXT_LENGTH
            ),
            self::TOO_LONG_BUTTON_OBJECT_TEXT_EXCEPTION_CODE
        );
    }
}
