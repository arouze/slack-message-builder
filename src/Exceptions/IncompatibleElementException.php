<?php

namespace Arouze\SlackMessageBuilder\Exceptions;

class IncompatibleElementException extends AbstractBaseException
{
    private const INCOMPATIBLE_BLOCK_ELEMENT = 2012;

    public function __construct(
        string $incompatibleElement,
        string $currentBlock,
        array $compatibleElements
    ) {
        parent::__construct(
            sprintf(
                "Element %s in not compatible with %s block. Compatible elements : %s.",
                $incompatibleElement,
                $currentBlock,
                implode(', ', $compatibleElements)
            ),
            self::INCOMPATIBLE_BLOCK_ELEMENT
        );
    }
}
