<?php

namespace Arouze\SlackMessageBuilder\Elements;

interface FocusableInterface
{
    public function focusOnLoad(): FocusableInterface;
}
