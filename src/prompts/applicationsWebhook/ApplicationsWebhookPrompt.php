<?php

namespace andy87\client\avito\prompts\applicationsWebhook;

use BaseClient\BasePrompt;
use BaseClient\PromptInterface;

/**
 * Prompt for retrieving information about Avito webhook subscriptions (applications).
 */
class ApplicationsWebhookPrompt extends BasePrompt implements PromptInterface
{
    /**
     * Webhook URL to filter by (optional).
     */
    public string $url;

    /**
     * Webhook secret key to filter by (optional).
     */
    public string $secret;

    /**
     * Initialize a new ApplicationsWebhookPrompt.
     * @param string $url Webhook URL to query.
     * @param string $secret Secret key of the webhook (if required).
     */
    public function __construct(string $url, string $secret = 'secret')
    {
        $this->url = $url;
        $this->secret = $secret;
        // Configure the HTTP request details for the webhook info endpoint
        $this->method = 'GET';
        $this->path = 'applications/webhook';
        // Include URL and secret as query parameters
        $this->body = [
            'url'    => $this->url,
            'secret' => $this->secret,
        ];
    }

    /**
     * {@inheritDoc}
     */
    public function getResponseClass(): string
    {
        return ApplicationsWebhookResponse::class;
    }
}
