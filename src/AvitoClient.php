<?php

namespace andy87\avito\client;

use andy87\avito\client\base\Client;
use andy87\avito\client\prompts\applicationsWebhook\ApplicationsWebhookPrompt;
use andy87\avito\client\schema\applicationsWebhook\ApplicationsWebhookGetSchema;

/**
 * AvitoClient
 */
abstract class AvitoClient extends Client
{
    /**
     * @param ApplicationsWebhookPrompt $applicationsWebhookPrompt
     *
     * @return ?ApplicationsWebhookGetSchema
     */
    public function applicationsWebhookGet( ApplicationsWebhookPrompt $applicationsWebhookPrompt ): ?ApplicationsWebhookGetSchema
    {
        $schema = $this->send( $applicationsWebhookPrompt );

        if ( $schema instanceof ApplicationsWebhookGetSchema )
        {
            return $schema;

        } else {

            $this->errorHandler([
                'method' => __METHOD__,
                'message' => 'Invalid response type',
                'prompt' => $applicationsWebhookPrompt,
                'response' => $schema
            ]);

            return null;
        }
    }
}
