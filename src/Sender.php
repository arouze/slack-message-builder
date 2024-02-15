<?php

namespace Arouze\SlackMessageBuilder;

use Symfony\Component\HttpClient\HttpClient;
use Symfony\Contracts\HttpClient\HttpClientInterface;

class Sender
{
    private HttpClientInterface $httpClient;

    public function __construct()
    {
        $this->httpClient = HttpClient::create();
    }

    public function sendToChannel(
        string $channel,
        string $serviceId,
        string $channelId,
        string $channelToken,
        array $blocks
    ): void {
        $this->httpClient->request(
            'POST',
            sprintf(
                "https://hooks.slack.com/services/%s/%s/%s",
                $serviceId,
                $channelId,
                $channelToken
            ),
            [
                'headers' => [
                    'Content-Type' => 'application/json',
                ],
                'body' => json_encode([
                    'channel' => $channel,
                    'blocks' => $blocks
                ])
            ]
        );
    }
}
