<?php

namespace andy87\avito\client;

use Exception;
use andy87\avito\client\ext\AvitoAccount;
use andy87\avito\client\helpers\GrantType;
use andy87\avito\client\schema\token\AccessTokenSchema;
use andy87\avito\client\prompts\token\AccessTokenPrompt;
use andy87\avito\client\prompts\applicationsWebhook\ApplicationsWebhookPrompt;
use andy87\avito\client\schema\applicationsWebhook\ApplicationsWebhookGetSchema;

/**
 * AvitoService
 *
 * Предоставляет методы для работы с Avito API.
 *
 * Сервис служит для упрощения взаимодействия с API, убирая необходимость создания экземпляров Prompts и Client вручную.
 */
class AvitoService
{
    private AvitoClient $client;

    public function __construct( string $clientClass, string $configClass,  string $clientId, string $clientSecret ) {

        $account = new AvitoAccount( $clientId, $clientSecret );

        $config = new $configClass( $account );

        $this->client = new $clientClass($config);
    }

    /**
     * @param string $grantType
     *
     * @return ?AccessTokenSchema
     *
     * @throws Exception
     */
    public function getAccessToken( string $grantType = GrantType::CLIENT_CREDENTIALS ): ?AccessTokenSchema
    {
        /** @var AvitoAccount $account */
        $account = $this->client->config->getAccount();

        $promptToken = new AccessTokenPrompt( $account->clientId, $account->clientSecret, $grantType );

        /** @var ?AccessTokenSchema $response */
        $response = $this->client->getAccessToken( $promptToken );

        return $response;
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

        /** @var ?ApplicationsWebhookGetSchema $response */
        $response = $this->client->applicationsWebhookGet( $applicationsWebhookPrompt );

        return $response;
    }
}