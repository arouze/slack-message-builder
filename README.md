# Slack Message Builder
A builder for Slack message written in PHP.

## Objective

Building Slack message using block kit is quite hard.
This package will help you to build message easily and will warn you if you don't respect Slack restrictions (Message too large, too much elements in an action block)

## Usage

```php
    // Will return an array of Slack blocks
    // You can post them on the Slack webhook using json_encode
    $blocks = (new SlackMessageBuilder())
        ->addBlock(
            (new SectionBlock())
            ->setTextObject(
                (new TextObject())
                ->setType(TextObject::TEXT_OBJECT_TYPE_MARKDOWN)
                ->setText("Hello!\n\n *What a nice day to build slack Message !*")
            )
        )
        ->addBlock((new DividerBlock()))
        ->addBlock(
            (new ActionBlock())
            ->addElement(
                (new ButtonElement())
                    ->setButtonTextObject(
                        (new ButtonTextObject())
                        ->setText('Great !')
                    )
                    ->setStyle(ButtonElement::BUTTON_STYLE_PRIMARY)
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
- [ ] Workflow button

#### [Rich Text Elements](https://api.slack.com/reference/block-kit/blocks#rich_text)
- [x] RichTextSection
- [ ] RichTextList
- [ ] RichTextPreformatted
- [ ] RichTextQuote

### [Composition Objects](https://api.slack.com/reference/block-kit/composition-objects) 
- [x] Confirmation dialog object
- [ ] Conversation filter object
- [x] Dispatch action configuration object
- [x] Option object
- [x] Option group object
- [x] Text object
- [x] Trigger object
- [x] Workflow object
- [x] Slack file object

#### [Rich Text Object Type](https://api.slack.com/reference/block-kit/blocks#channel-element-type)
- [x] Channel
- [ ] Emoji
- [ ] Link
- [ ] Text
- [ ] User
- [ ] UserGroup
