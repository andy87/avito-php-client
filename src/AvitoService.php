<?php

namespace andy87\avito\client;

use andy87\avito\client\prompts\applicationsWebhook\ApplicationsWebhookDeletePrompt;
use andy87\avito\client\prompts\applicationsWebhook\ApplicationsWebhookGetPrompt;
use andy87\avito\client\prompts\applicationsWebhook\ApplicationsWebhookPutPrompt;
use andy87\avito\client\schema\applicationsWebhook\ApplicationsWebhookDeleteSchema;
use andy87\avito\client\schema\applicationsWebhook\ApplicationsWebhookPutSchema;
use Exception;
use andy87\avito\client\ext\AvitoAccount;
use andy87\avito\client\helpers\GrantType;
use andy87\avito\client\schema\token\AccessTokenSchema;
use andy87\avito\client\prompts\token\AccessTokenPrompt;
use andy87\avito\client\prompts\applicationsWebhook\ApplicationsWebhookPrompt;
use andy87\avito\client\schema\applicationsWebhook\ApplicationsWebhookSchema;

/**
 * AvitoService
 *
 * Предоставляет методы для работы с Avito API.
 *
 * Сервис служит для упрощения взаимодействия с API, убирая необходимость создания экземпляров Prompts и Client вручную.
 */
class AvitoService
{
    protected const CLASS_CONFIG = AvitoConfig::class;
    protected const CLASS_CLIENT = AvitoClient::class;
    protected const CLASS_ACCOUNT = AvitoAccount::class;

    private AvitoClient $client;

    /**
     * Конструктор для создания сервиса Avito API.
     *
     * @throws Exception
     */
    public function __construct( AvitoAccount $account )
    {
        $this->setupClient($account);
    }

    /**
     * Создает экземпляр AvitoClient с заданной конфигурацией.
     *
     * @param AvitoAccount $account
     *
     * @return void
     *
     * @throws Exception
     */
    private function setupClient( AvitoAccount $account ): void
    {
        $config = $this->constructConfig($account);

        $this->client = $this->getClient($config);
    }

    /**
     * Создает конфигурацию для Avito API клиента.
     *
     * @param AvitoAccount $avitoAccount
     *
     * @return AvitoConfig
     *
     * @throws Exception
     */
    protected function constructConfig(AvitoAccount $avitoAccount): AvitoConfig
    {
        $configClass = static::CLASS_CONFIG;

        if ( !is_subclass_of( $configClass, AvitoClient::class ) ) {
            throw new Exception( "Класс $configClass должен быть подклассом AvitoConfig" );
        }

        return new $configClass( $avitoAccount );

    }

    /**
     * Инициализирует клиент Avito API с заданной конфигурацией.
     *
     * @param AvitoConfig $config
     *
     * @return AvitoClient
     *
     * @throws Exception
     */
    protected function getClient(AvitoConfig $config): AvitoClient
    {
        $clientClass = static::CLASS_CLIENT;

        if ( !is_subclass_of( $clientClass, AvitoClient::class ) ) {
            throw new Exception( "Класс $clientClass должен быть подклассом AvitoClient" );
        }

        return new $clientClass( $config );
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
     * @return ?ApplicationsWebhookSchema
     *
     * @throws Exception
     */
    public function applicationsWebhookGet( string $url, string $secret = ApplicationsWebhookPrompt::DEFAULT_SECRET ): ?ApplicationsWebhookSchema
    {
        $applicationsWebhookPrompt = new ApplicationsWebhookGetPrompt( $url, $secret );

        /** @var ?ApplicationsWebhookSchema $response */
        $response = $this->client->applicationsWebhookGet( $applicationsWebhookPrompt );

        return $response;
    }

    /**
     * @param string $url
     * @param string $secret
     *
     * @return ?ApplicationsWebhookPutSchema
     *
     * @throws Exception
     */
    public function applicationsWebhookPut( string $url, string $secret = ApplicationsWebhookPrompt::DEFAULT_SECRET ): ?ApplicationsWebhookPutSchema
    {
        $applicationsWebhookPutPrompt = new ApplicationsWebhookPutPrompt( $url, $secret );

        /** @var ?ApplicationsWebhookPutSchema $response */
        $response = $this->client->applicationsWebhookGet( $applicationsWebhookPutPrompt );

        return $response;
    }

    /**
     * @return ?ApplicationsWebhookDeleteSchema
     *
     * @throws Exception
     */
    public function applicationsWebhookDelete(): ?ApplicationsWebhookDeleteSchema
    {
        $applicationsWebhookDeletePrompt = new ApplicationsWebhookDeletePrompt();

        /** @var ?ApplicationsWebhookDeleteSchema $response */
        $response = $this->client->applicationsWebhookDelete( $applicationsWebhookDeletePrompt );

        return $response;
    }
}