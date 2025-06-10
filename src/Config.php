<?php

namespace andy87\client\avito;

use BaseClient\BaseConfig;

/**
 * Configuration for Avito API client.
 * Holds Avito-specific settings like base URI and credentials.
 */
class Config extends BaseConfig
{
    /**
     * Avito API application Client ID.
     */
    public string $clientId;

    /**
     * Avito API application Client Secret.
     */
    public string $clientSecret;

    /**
     * Construct AvitoConfig with required credentials.
     * @param string $clientId Avito API Client ID.
     * @param string $clientSecret Avito API Client Secret.
     * @param string $baseUri Base URI for Avito API (optional).
     * @param string $prefix API version prefix (optional).
     */
    public function __construct(string $clientId, string $clientSecret, string $baseUri = 'https://api.avito.ru', string $prefix = 'v1')
    {
        $this->clientId = $clientId;
        $this->clientSecret = $clientSecret;
        parent::__construct($baseUri, $prefix);
        // Avito API uses JSON format for requests/responses
        $this->defaultHeaders = [
            'Content-Type' => 'application/json',
            'Accept'       => 'application/json',
        ];
        // Set default timeouts (in seconds)
        $this->connectTimeout = 2;
        $this->readTimeout = 30;
    }
}
