<?php

namespace andy87\avito\client;

use Exception;
use andy87\avito\client\ext\AvitoAccount;
use andy87\sdk\client\base\interfaces\ClientInterface;
use andy87\sdk\client\base\modules\{AbstractCache, AbstractLogger, AbstractTest, AbstractTransport};

/**
 * AvitoService
 *
 * Предоставляет методы для работы с Avito API.
 *
 * Сервис служит для упрощения взаимодействия с API, убирая необходимость создания экземпляров Prompts и Client вручную.
 *
 * @package src
 */
class AvitoService
{
    protected const CLASS_CONFIG = AvitoConfig::class;
    protected const CLASS_CLIENT = AvitoClient::class;

    private AvitoClient $client;



    /**
     * Конструктор для создания сервиса Avito API.
     *
     * @throws Exception
     */
    public function __construct( AvitoAccount $account )
    {
        $this->setupClient( $account );
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

        $this->client = $this->constructClient($config);
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
    protected function constructConfig( AvitoAccount $avitoAccount ): AvitoConfig
    {
        $configClass = static::CLASS_CONFIG;

        $config = new $configClass( $avitoAccount );

        if ( $config instanceof AvitoConfig ) return $config;

        throw new Exception( "Класс $configClass должен быть подклассом AvitoConfig" );
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
    protected function constructClient(AvitoConfig $config): AvitoClient
    {
        $clientClass = static::CLASS_CLIENT;

        $client = new $clientClass( $config );

        if ( $client instanceof AvitoClient ) return $client;

        throw new Exception( "Класс $clientClass должен быть подклассом AvitoClient" );
    }

    /**
     * Получает экземпляр клиента Avito API.
     *
     * @return AvitoClient
     */
    public function getClient(): AvitoClient
    {
        return $this->client;
    }

    /**
     * Получает менеджер операторов Avito.
     *
     * @return AvitoOperatorManager
     */
    public function getOperator(): AvitoOperatorManager
    {
        return $this->getClient()->operatorManager;
    }

    /**
     * Получает модуль по его имени.
     *
     * @param string $moduleName
     *
     * @return null|AbstractLogger|AbstractCache|AbstractTest|AbstractTransport
     *
     * @throws Exception
     */
    protected function getModule( string $moduleName ): null|AbstractLogger|AbstractCache|AbstractTest|AbstractTransport
    {
        return $this->client->getModule( $moduleName );
    }

    /**
     * @param mixed $data
     *
     * @return null|bool
     *
     * @throws Exception
     */
    public function cacheSet( string $data ): ?bool
    {
        $account = $this->client->getConfig()->getAccount();

        return $this->getModule(ClientInterface::CACHE)?->setData( $account, $data );
    }

    /**
     * @return mixed
     *
     * @throws Exception
     */
    public function cacheGet(): mixed
    {
        $account = $this->client->getConfig()->getAccount();

        return $this->getModule(ClientInterface::CACHE)?->getData( $account );
    }
}