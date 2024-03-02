<?php

namespace Arouze\Tests\Objects;

class DispatchActionConfigurationObject
{
    // @doc : https://api.slack.com/reference/block-kit/composition-objects#dispatch_action_config
    public const ON_ENTER_PRESSED = 'on_enter_pressed';

    public const ON_CHARACTER_ENTERED = 'on_character_entered';
    private array $interactions = [];

    public function toArray(): array
    {
        return [
            'trigger_actions_on' => $this->interactions
        ];
    }
}
