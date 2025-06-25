<?php

namespace andy87\avito\client;

use andy87\avito\client\ext\AvitoSchema;
use andy87\sdk\client\base\components\Schema;
use andy87\sdk\client\base\interfaces\RequestInterface;
use andy87\sdk\client\core\transport\Request;
use andy87\sdk\client\core\transport\Response;
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
     * Расширение для обработки схемы ответа.
     * Добавление данных `Response` в случае ошибки.
     *
     * @param RequestInterface $request
     * @param Response $response
     *
     * @return null|AvitoSchema
     *
     * @throws Exception
     */
    protected function constructSchema( RequestInterface $request, Response $response ): null|AvitoSchema
    {
        /** @var AvitoSchema $schema */
        $schema = parent::constructSchema( $request, $response );

        if ( $schema->result && !$schema->result->status )
        {
            $schema->result->response = $response;
        }

        return $schema;
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

        return $this->operatorManager->authOperator->getAccessToken( $account->client_id, $account->client_secret );
    }
}
