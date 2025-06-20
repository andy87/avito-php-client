<?php

namespace andy87\avito\client;

use andy87\avito\client\helpers\GrantType;
use Exception;
use andy87\avito\client\ext\Account;
use andy87\avito\client\schema\token\AccessTokenSchema;
use andy87\avito\client\prompts\token\AccessTokenPrompt;
use andy87\avito\client\prompts\applicationsWebhook\ApplicationsWebhookPrompt;
use andy87\avito\client\schema\applicationsWebhook\ApplicationsWebhookGetSchema;

/**
 * AvitoService
 *
 * Предоставляет методы для работы с Avito API.
 */
class AvitoService
{
    private AvitoClient $client;

    public function __construct( string $clientClass, string $configClass,  string $clientId, string $clientSecret ) {

        $account = new Account( $clientId, $clientSecret );

        $config = new $configClass( $account );

        $this->client = new $clientClass($config);
    }

    /**
     * @param string $grantType
     *
     * @return AccessTokenSchema
     *
     * @throws Exception
     */
    public function getAccessToken( string $grantType = GrantType::CLIENT_CREDENTIALS ): AccessTokenSchema
    {
        /** @var Account $account */
        $account = $this->client->config->getAccount();

        $promptToken = new AccessTokenPrompt( $account->clientId, $account->clientSecret, $grantType );

        return $this->client->getAccessToken( $promptToken );
    }

    /**
     * @param string $url
     * @param string $secret
     *
     * @return ?ApplicationsWebhookGetSchema
     *
     * @throws Exception
     */
    public function applicationsWebhookGet( string $url, string $secret = ApplicationsWebhookPrompt::DEFAULT_SECRET ): ?ApplicationsWebhookGetSchema
    {
        $applicationsWebhookPrompt = new ApplicationsWebhookPrompt( $url, $secret );

        return $this->client->applicationsWebhookGet( $applicationsWebhookPrompt );
    }
}