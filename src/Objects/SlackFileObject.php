<?php

namespace Arouze\SlackMessageBuilder\Objects;

use Arouze\SlackMessageBuilder\Exceptions\MissingFieldException;

class SlackFileObject implements ObjectInterface
{
    // @see : https://api.slack.com/reference/block-kit/composition-objects#slack_file
    private ?string $url = null;

    private ?string $id = null;

    public function toArray(): array
    {
        if (!is_null($this->url)) {
            return [
                'url' => $this->url
            ];
        }

        if (!is_null($this->id)) {
            return [
                'id' => $this->id
            ];
        }

        throw new MissingFieldException(self::class, 'url, id');
    }

    public function setUrl(?string $url): SlackFileObject
    {
        $this->url = $url;

        return $this;
    }

    public function setId(?string $id): SlackFileObject
    {
        $this->id = $id;

        return $this;
    }
}
