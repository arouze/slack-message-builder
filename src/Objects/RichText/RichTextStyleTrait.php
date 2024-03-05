<?php

namespace Arouze\SlackMessageBuilder\Objects\RichText;

use Arouze\SlackMessageBuilder\Exceptions\IncorrectStyleException;

trait RichTextStyleTrait
{
    public const STYLE_BOLD = 'bold';
    public const STYLE_ITALIC = 'italic';
    public const STYLE_STRIKE = 'strike';
    public const STYLE_HIGHLIGHT = 'highlight';
    public const STYLE_CLIENT_HIGHLIGHT = 'client_highlight';
    public const STYLE_UNLINK = 'unlink';

    public const STYLE_CODE = 'code';

    public function addStyle(string $style): self
    {
        $this->validateStyle($style, self::AVAILABLE_STYLES);

        $this->block['style'][$style] = true;

        return $this;
    }
    private function validateStyle(string $style, array $availableStyles): void
    {
        if (
            !in_array(
                $style,
                $availableStyles
            )
        ) {
            throw new IncorrectStyleException(self::class, $availableStyles);
        }
    }
}
