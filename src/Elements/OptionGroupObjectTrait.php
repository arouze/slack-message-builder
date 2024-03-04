<?php

namespace Arouze\SlackMessageBuilder\Elements;

use Arouze\SlackMessageBuilder\Exceptions\TooMuchOptionGroupsException;
use Arouze\SlackMessageBuilder\Objects\OptionGroupObject;

trait OptionGroupObjectTrait
{
    private array $optionGroups = [];

    public function addOptionGroup(OptionGroupObject $optionGroupObject): self
    {
        $this->optionGroups[] = $optionGroupObject;

        return $this;
    }
    private function handleOptionGroup(): self
    {
        /** @var OptionGroupObject $optionGroup */
        foreach ($this->optionGroups as $optionGroup) {
            $this->block['option_groups'][] = $optionGroup->toArray();
        }

        return $this;
    }

    private function validateOptionGroup(int $maxOptionsGroup): void
    {
        if (count($this->optionGroups) > $maxOptionsGroup) {
            throw new TooMuchOptionGroupsException(
                count($this->optionGroups),
                $maxOptionsGroup,
                self::class
            );
        }
    }
}
