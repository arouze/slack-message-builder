# Slack Message Builder
A builder for Slack message written in PHP.

## Objective

Building Slack message using block kit is quite hard.
This package will help you to build message easily and will warn you if you don't respect Slack restrictions (Message too large, too much elements in an action block)

## Installation

```shell
composer require arouze/slack-message-builder
```

## Usage

```php
    // Here an example with the first template of Slack Documentation
    // @see: https://api.slack.com/tools/block-kit-builder?template=1
    // Will return an array of Slack blocks
    // You can post them on the Slack webhook using json_encode
    $blocks = (new SlackMessageBuilder())
        ->addBlock(
            (new SectionBlock())
                ->setTextObject(
                    (new TextObject())
                        ->setType(TextObject::TEXT_OBJECT_TYPE_MARKDOWN)
                        ->setText("You have a new request:\n*<fakeLink.toEmployeeProfile.com|Fred Enriquez - New device request>*")
                )
        )
        ->addBlock(
            (new SectionBlock())
                ->addFields(
                    (new TextObject())
                        ->setType(TextObject::TEXT_OBJECT_TYPE_MARKDOWN)
                        ->setText("Type:*\nComputer (laptop)")
                )
                ->addFields(
                    (new TextObject())
                        ->setType(TextObject::TEXT_OBJECT_TYPE_MARKDOWN)
                        ->setText("*When:*\nSubmitted Aut 10")
                )
                ->addFields(
                    (new TextObject())
                        ->setType(TextObject::TEXT_OBJECT_TYPE_MARKDOWN)
                        ->setText("*Last Update:*\nMar 10, 2015 (3 years, 5 months)")
                )
                ->addFields(
                    (new TextObject())
                        ->setType(TextObject::TEXT_OBJECT_TYPE_MARKDOWN)
                        ->setText("*Reason:*\nAll vowel keys aren't working.")
                )
                ->addFields(
                    (new TextObject())
                        ->setType(TextObject::TEXT_OBJECT_TYPE_MARKDOWN)
                        ->setText("*Specs:*\n\"Cheetah Pro 15\" - Fast, really fast\"")
                )
        )
        ->addBlock(
            (new ActionBlock())
                ->addElement(
                    (new ButtonElement())
                        ->setText(
                            (new TextObject())
                                ->escapeEmoji()
                                ->setText('Approve')
                        )
                        ->setStyle(ButtonElement::BUTTON_STYLE_PRIMARY)
                        ->setValue('click_me_123')
                )
                ->addElement(
                    (new ButtonElement())
                        ->setText(
                            (new TextObject())
                                ->escapeEmoji()
                                ->setText('Deny')
                        )
                        ->setStyle(ButtonElement::BUTTON_STYLE_DANGER)
                        ->setValue('click_me_123')
                )
        )
        ->render();

    // Or you can use the Sender to easily send message in your Slack channels.
    // @see https://api.slack.com/messaging/webhooks to configure a webhook on your Slack instance.
    (new Sender())->sendToChannel(
        'channel-name',
        'SERVICE_ID',
        'CHANNEL_ID',
        'CHANNEL_TOKEN',
        $blocks
    );
```

## Features

### [Blocks](https://api.slack.com/reference/block-kit/blocks) 
- [x] Action
- [x] Context
- [x] Divider
- [x] File
- [x] Header
- [x] Image
- [x] Input
- [x] RichText
- [x] Section
- [x] Video

### [Elements](https://api.slack.com/reference/block-kit/block-elements)
- [x] Button
- [x] Checkboxes
- [x] Date pickers
- [x] Datetime pickers
- [x] Email input
- [x] File input
- [x] Image
- [x] Multi-select menus
- [x] Number input
- [x] Overflow menu
- [x] Plain-text input
- [x] Radio buttons
- [x] Rich text input
- [x] Select menus
- [x] Time pickers
- [x] URL input
- [x] Workflow button

#### [Rich Text Elements](https://api.slack.com/reference/block-kit/blocks#rich_text)
- [x] RichTextSection
- [x] RichTextList
- [x] RichTextPreformatted
- [x] RichTextQuote

### [Composition Objects](https://api.slack.com/reference/block-kit/composition-objects) 
- [x] Confirmation dialog object
- [x] Conversation filter object
- [x] Dispatch action configuration object
- [x] Option object
- [x] Option group object
- [x] Text object
- [x] Trigger object
- [x] Workflow object
- [x] Slack file object

#### [Rich Text Object Type](https://api.slack.com/reference/block-kit/blocks#channel-element-type)
- [x] Channel
- [x] Emoji
- [x] Link
- [x] Text
- [x] User
- [x] UserGroup

## Want to help ? An issue ?

- [You can open an issue](https://github.com/arouze/slack-message-builder/issues/new)
