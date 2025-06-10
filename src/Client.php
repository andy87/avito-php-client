<?php

namespace andy87\client\avito;

use Exception;
use andy87\client\avito\core\BaseClient;
use Psr\Http\Client\ClientExceptionInterface;
use andy87\client\avito\prompts\token\TokenPrompt;
use andy87\client\avito\response\token\TokenResponse;

/**
 * Client for Avito API, extending the base client with specific API methods.
 */
class Client extends BaseClient
{


    /**
     * Retrieve information about existing webhook subscriptions for applications.
     * @param ApplicationsWebhookPrompt $prompt Prompt containing query parameters (URL and secret).
     * @return ApplicationsWebhookGetResponse|null The webhook info response, or null if request failed.
     * @throws ClientExceptionInterface if an HTTP error occurs and is not handled.
     */
    public function applicationsWebhookGet(ApplicationsWebhookPrompt $prompt): ?ApplicationsWebhookGetResponse
    {
        $response = $this->send($prompt);

        return ($response instanceof ApplicationsWebhookGetResponse) ? $response :null;
    }

}
