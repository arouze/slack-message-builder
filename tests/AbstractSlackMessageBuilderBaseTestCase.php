<?php

namespace Arouze\Tests;

use Arouze\SlackMessageBuilder\Elements\ButtonElement;
use Arouze\SlackMessageBuilder\Elements\DateTimePickerElement;
use Faker\Factory;
use Faker\Generator;
use PHPUnit\Framework\TestCase;

abstract class AbstractSlackMessageBuilderBaseTestCase extends TestCase
{
    use ObjectBuilderTrait;

    protected Generator $fakerGenerator;
    public function __construct(string $name)
    {
        $this->fakerGenerator = Factory::create();
        parent::__construct($name);
    }

    protected static function buildButtonElement(): ButtonElement
    {
        return (new ButtonElement())
            ->setText(self::buildButtonTextObject());
    }

    protected static function buildDateTimePickerElement(): DateTimePickerElement
    {
        return (new DateTimePickerElement());
    }
}
