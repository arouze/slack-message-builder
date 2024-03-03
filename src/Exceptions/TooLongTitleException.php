<?php

namespace Arouze\SlackMessageBuilder\Exceptions;

use Arouze\SlackMessageBuilder\Elements\ImageElement;

class TooLongTitleException extends AbstractBaseException
{
    private const TOO_LONG_TITLE = 2006;
    public function __construct(int $titleLength)
    {
        parent::__construct(
            sprintf(
                "Title is too long (%d). " .
                "Maximum length is %d (@see https://api.slack.com/reference/block-kit/block-elements#image)",
                $titleLength,
                ImageElement::MAXIMUM_TITLE_LENGTH
            ),
            self::TOO_LONG_TITLE
        );
    }
}
