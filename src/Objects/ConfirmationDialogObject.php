<?php

namespace Arouze\SlackMessageBuilder\Objects;

use Arouze\SlackMessageBuilder\Exceptions\TooLongTextException;

class ConfirmationDialogObject implements ObjectInterface
{
    // @doc : https://api.slack.com/reference/block-kit/composition-objects#confirm

    private const MAX_TITLE_LENGTH = 100;

    private const MAX_TEXT_LENGTH = 300;

    private const MAX_CONFIRM_LENGTH = 30;

    private const MAX_DENY_LENGTH = 30;

    public const PRIMARY_STYLE = 'primary';

    public const DANGER_STYLE = 'danger';

    private array $block = [];

    private TextObject $title;

    private TextObject $text;

    private TextObject $confirm;

    private TextObject $deny;

    private string $style = self::PRIMARY_STYLE;

    public function setTitle(TextObject $title): ConfirmationDialogObject
    {
        $this->title = $title;

        return $this;
    }

    public function setText(TextObject $text): ConfirmationDialogObject
    {
        $this->text = $text;

        return $this;
    }

    public function setConfirm(TextObject $confirm): ConfirmationDialogObject
    {
        $this->confirm = $confirm;

        return $this;
    }

    public function setDeny(TextObject $deny): ConfirmationDialogObject
    {
        $this->deny = $deny;

        return $this;
    }

    public function setStyle(?string $style): ConfirmationDialogObject
    {
        $this->style = $style;

        return $this;
    }

    private function validate(): void
    {
        if (strlen($this->title->getText()) > self::MAX_TITLE_LENGTH) {
            throw new TooLongTextException(strlen($this->title->getText()), self::MAX_TITLE_LENGTH, 'title');
        }

        if (strlen($this->text->getText()) > self::MAX_TEXT_LENGTH) {
            throw new TooLongTextException(strlen($this->text->getText()), self::MAX_TEXT_LENGTH, 'text');
        }

        if (strlen($this->confirm->getText()) > self::MAX_CONFIRM_LENGTH) {
            throw new TooLongTextException(strlen($this->confirm->getText()), self::MAX_CONFIRM_LENGTH, 'confirm');
        }

        if (strlen($this->deny->getText()) > self::MAX_DENY_LENGTH) {
            throw new TooLongTextException(strlen($this->deny->getText()), self::MAX_DENY_LENGTH, 'deny');
        }
    }

    public function toArray(): array
    {
        $this->validate();

        $this->block['title'] = $this->title->toArray();
        $this->block['text'] = $this->text->toArray();
        $this->block['confirm'] = $this->confirm->toArray();
        $this->block['deny'] = $this->deny->toArray();

        if ($this->style !== self::PRIMARY_STYLE) {
            $this->block['style'] = self::DANGER_STYLE;
        }

        return $this->block;
    }
}
