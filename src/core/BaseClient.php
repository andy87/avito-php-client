<?php

namespace andy87\client\avito\core;

use andy87\client\avito\prompts\token\TokenPrompt;
use andy87\client\avito\response\token\TokenResponse;
use Psr\Http\Client\ClientExceptionInterface;

/**
 * Client for Avito API, extending the base client with specific API methods.
 */
abstract class BaseClient extends andy87\sdk\php\client\SdkClient
{
    protected Account $account;

    /**
     * @throws ClientExceptionInterface
     */
    public function authorization(): bool
    {
        $tokenPrompt = new TokenPrompt($this->account->clientId, $this->account->clientSecret);

        $tokenResponse = $this->getAccessToken($tokenPrompt);

        if ($tokenResponse === null) {
            $this->errorHandler( $tokenPrompt, $tokenResponse );
        }

        $this->setupCache( $tokenResponse );

        $this->headers['Authorization'] = 'Bearer ' . $tokenResponse->accessToken;
    }

    /**
     * Obtain a new access token from Avito API.
     * @param TokenPrompt $prompt Prompt containing OAuth client credentials.
     * @return ?TokenResponse The token response, or null if the request failed.
     * @throws ClientExceptionInterface if an HTTP error occurs and is not handled.
     */
    public function getAccessToken(TokenPrompt $prompt): ?TokenResponse
    {
        $response = $this->send($prompt);

        return ($response instanceof TokenResponse) ? $response :null;
    }
}
