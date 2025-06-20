<?php

namespace andy87\avito\client;

use Exception;
use andy87\avito\client\ext\Client;
use andy87\avito\client\prompts\applicationsWebhook\ApplicationsWebhookPrompt;
use andy87\avito\client\schema\applicationsWebhook\ApplicationsWebhookGetSchema;

/**
 * AvitoClient
 */
abstract class AvitoClient extends Client
{
    // тут будут все запросы к API Avito

    /**
     * @param ApplicationsWebhookPrompt $applicationsWebhookPrompt
     *
     * @return ?ApplicationsWebhookGetSchema
     *
     * @throws Exception
     */
    public function applicationsWebhookGet( ApplicationsWebhookPrompt $applicationsWebhookPrompt ): ?ApplicationsWebhookGetSchema
    {
        /** @var ?ApplicationsWebhookGetSchema $schema */
        $schema = $this->send( $applicationsWebhookPrompt );

        if ( !$schema )
        {
            $this->errorHandler([
                'method' => __METHOD__,
                'message' => 'Invalid response type',
                'prompt' => $applicationsWebhookPrompt,
                'response' => $schema
            ]);
        }

        return $schema;
    }
}
