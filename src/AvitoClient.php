<?php

namespace andy87\avito\client;

use Exception;
use andy87\avito\client\ext\AvitoBaseClient;
use andy87\avito\client\schema\auth\AccessTokenSchema;

/**
 * Клиент для использования API Авито.
 *
 * Этот клиент предоставляет доступ к различным операторам,
 * которые позволяют взаимодействовать с API Авито.
 *
 * @method AvitoConfig getConfig()
 *
 * @package src
 */
class AvitoClient extends AvitoBaseClient
{
    public AvitoOperatorManager $operatorManager;



    /**
     * Конструктор
     *
     * @param AvitoConfig $config
     *
     * @throws Exception
     */
    public function __construct( AvitoConfig $config )
    {
        parent::__construct( $config );

        $this->operatorManager = new AvitoOperatorManager( $this );
    }

    /**
     * Получение access token
     * Получения временного ключа для авторизации
     *
     * @return null|AccessTokenSchema
     *
     * @throws Exception
     */
    public function getAccessToken(): ?AccessTokenSchema
    {
        $account = $this->config->getAccount();

        return $this->operatorManager->authOperator->getAccessToken( $account );
    }
}
