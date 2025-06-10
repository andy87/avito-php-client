<?php

namespace andy87\client\avito\prompts\token;

use andy87\client\avito\core\GrantType;
use BaseClient\BasePrompt;
use BaseClient\PromptInterface;

/**
 * Prompt for obtaining an OAuth access token from Avito API.
 */
class TokenPrompt extends BasePrompt implements PromptInterface
{
    /**
     * OAuth grant type (e.g. "client_credentials").
     */
    public string $grantType;

    /**
     * Avito API Client ID.
     */
    public string $clientId;

    /**
     * Avito API Client Secret.
     */
    public string $clientSecret;

    /**
     * Initialize a new TokenPrompt.
     * @param string $clientId Avito API Client ID.
     * @param string $clientSecret Avito API Client Secret.
     * @param string $grantType OAuth grant type (default "client_credentials").
     */
    public function __construct(string $clientId, string $clientSecret, string $grantType = GrantType::GRANT_TYPE_CLIENT_CREDENTIALS )
    {
        $this->clientId = $clientId;
        $this->clientSecret = $clientSecret;
        $this->grantType = $grantType;
        // Configure the HTTP request details for the token endpoint
        $this->method = 'POST';
        $this->path = 'token';
        $this->body = [
            'client_id'     => $this->clientId,
            'client_secret' => $this->clientSecret,
            'grant_type'    => $this->grantType,
        ];
        // No auth token required to get a new token
        $this->requiresAuth = false;
    }

    /**
     * {@inheritDoc}
     */
    public function getResponseClass(): string
    {
        return TokenResponse::class;
    }
}
