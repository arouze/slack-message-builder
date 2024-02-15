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

## Available features

### Accessories
- Image

### Blocks
- Section
- Divider
- Action

### Elements
- Button

### Objects
- TextObject
- ButtonTextObject

## Unavailable features

Almost everything...

List of elements to add : https://api.slack.com/reference/block-kit/block-elements
