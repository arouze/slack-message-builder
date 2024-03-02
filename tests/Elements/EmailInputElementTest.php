<?php

namespace Arouze\Tests\Elements;

use Arouze\SlackMessageBuilder\Elements\EmailInputElement;
use Arouze\SlackMessageBuilder\Exceptions\TooLongTextException;
use Arouze\Tests\AbstractSlackMessageBuilderBaseTestCase;
use Arouze\Tests\Objects\DispatchActionConfigurationObject;
use PHPUnit\Framework\Attributes\Group;

#[Group("EmailInputElement")]
#[Group("Elements")]
class EmailInputElementTest extends AbstractSlackMessageBuilderBaseTestCase
{
    public function testEmailInputElement(): void
    {
        self::assertEquals(
            [
                'type' => 'email_text_input'
            ],
            (new EmailInputElement())
                ->toArray()
        );
    }

    public function testEmailInputElementWithInitialValue(): void
    {
        $initialValue = $this->fakerGenerator->email();

        self::assertEquals(
            [
                'type' => 'email_text_input',
                'initial_value' => $initialValue
            ],
            (new EmailInputElement())
                ->setInitialValue($initialValue)
                ->toArray()
        );
    }

    public function testEmailInputElementWithDispatchActionConfig(): void
    {
        $dispatchActionConfig = new DispatchActionConfigurationObject();

        self::assertEquals(
            [
                'type' => 'email_text_input',
                'dispatch_action_config' => $dispatchActionConfig->toArray()
            ],
            (new EmailInputElement())
                ->setDispatchActionConfig($dispatchActionConfig)
                ->toArray()
        );
    }

    public function testEmailInputElementWithPlaceholder(): void
    {
        $placeholder = self::buildTextObject();
        $placeholder->setText($this->fakerGenerator->text(150));

        self::assertEquals(
            [
                'type' => 'email_text_input',
                'placeholder' => $placeholder->toArray()
            ],
            (new EmailInputElement())
                ->setPlaceholder($placeholder)
                ->toArray()
        );
    }

    public function testEmailInputWithTooLongPlaceholderException(): void
    {
        self::expectException(TooLongTextException::class);

        $placeholder = self::buildTextObject();
        $placeholder->setText($this->fakerGenerator->realTextBetween(151));

        (new EmailInputElement())
            ->setPlaceholder($placeholder)
            ->toArray();
    }
}
