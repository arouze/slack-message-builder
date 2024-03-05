<?php

namespace Arouze\SlackMessageBuilder\Objects;

use Arouze\SlackMessageBuilder\Exceptions\IncorrectIncludeException;

class ConversationFilterObject implements ObjectInterface
{
    // @doc : https://api.slack.com/reference/block-kit/composition-objects#filter_conversations

    public const INCLUDE_IM = 'im';
    public const INCLUDE_MPIM = 'mpim';
    public const INCLUDE_PRIVATE = 'private';
    public const INCLUDE_PUBLIC = 'public';

    private const AVAILABLE_INCLUDES = [
        self::INCLUDE_IM,
        self::INCLUDE_MPIM,
        self::INCLUDE_PRIVATE,
        self::INCLUDE_PUBLIC
    ];

    private array $block = [
        'filter' => []
    ];

    private array $include = [];

    private ?bool $excludeExternalSharedChannel = null;

    private ?bool $excludeBotUser = null;

    public function addInclude(string $include): self
    {
        if (!in_array($include, self::AVAILABLE_INCLUDES)) {
            throw new IncorrectIncludeException(self::class, self::AVAILABLE_INCLUDES);
        }

        $this->include[] = $include;

        return $this;
    }

    public function excludeExternalSharedChannel(): self
    {
        $this->excludeExternalSharedChannel = true;

        return $this;
    }

    public function includeExternalSharedChannel(): self
    {
        $this->excludeExternalSharedChannel = false;

        return $this;
    }

    public function excludeBotUser(): self
    {
        $this->excludeBotUser = true;

        return $this;
    }

    public function includeBotUser(): self
    {
        $this->excludeBotUser = false;

        return $this;
    }

    private function handleInclude(): self
    {
        $this->block['filter']['include'] = $this->include;

        return $this;
    }

    private function handleExcludeExternalSharedChannel(): self
    {
        if (!is_null($this->excludeExternalSharedChannel)) {
            $this->block['filter']['exclude_external_shared_channels'] = $this->excludeExternalSharedChannel;
        }

        return $this;
    }

    private function handleExcludeBotUser(): self
    {
        if (!is_null($this->excludeBotUser)) {
            $this->block['filter']['exclude_bot_users'] = $this->excludeBotUser;
        }

        return $this;
    }



    public function toArray(): array
    {
        $this
            ->handleInclude()
            ->handleExcludeExternalSharedChannel()
            ->handleExcludeBotUser();

        return $this->block;
    }
}
