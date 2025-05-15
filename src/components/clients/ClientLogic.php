<?php

namespace andy87\avito\client\components\clients;

use Exception;
use andy87\avito\client\prompts\Token;
use andy87\avito\client\components\base\Prompt;
use andy87\avito\client\components\base\Response;
use andy87\avito\client\components\base\Operator;
use andy87\avito\client\components\resources\TokenResponse;
use andy87\avito\client\components\interfaces\ClientInterface;
use andy87\avito\client\components\interfaces\CacheManagerInterface;

/**
 * Class ClientRoot
 *
 * Вспомогательный функционал для работы клиента
 *
 * @package src\components\clients
 */
abstract class ClientLogic implements ClientInterface
{
    /** @var string Класс с функционалом отправки запросов */
    public string $classOperator;

    /** @var Operator $operator Объект с функционалом отправки запросов */
    public Operator $operator;

    /** @var ?CacheManagerInterface */
    public ?CacheManagerInterface $accessCacheManager = null;

    /** @var Token $token Класс с данными для авторизации */
    public Token $token;


    /**
     * Constructor
     *
     * @param string $client_id
     * @param string $client_secret
     */
    public function __construct( string $client_id, string $client_secret )
    {
        $this->token = new Token( $client_id, $client_secret );

        $this->operator = $this->constructOperator($this->classOperator);

        $this->operator->setClient($this);
    }

    /**
     * Создание экземпляра класса оператора
     *
     * @param string $className
     *
     * @return Operator
     */
    protected function constructOperator(string $className): Operator
    {
        return new $className();
    }

    /**
     * Прослойка отправки запросов. Helper
     *  Что бы в коде было `$this->send()`
     *
     * @param Prompt $prompt
     *
     * @return ?Response
     *
     * @throws Exception
     */
    protected function send( Prompt $prompt ): ?Response
    {
        return $this->operator->send( $prompt );
    }

    /**
     * Устанавливает корректный метод, если не соответствует ожидаемому. Helper
     *  Что бы в коде было `$this->prepareMethod()`
     *
     * @param string $method
     * @param Prompt $params
     *
     * @return Prompt
     */
    protected function prepareMethod( string $method, Prompt $params ): Prompt
    {
        return $this->operator->prepareMethod( $method, $params );
    }

    /**
     * @param TokenResponse $response
     *
     * @return void
     */
    public function setCache( TokenResponse $response ): void
    {
        if ( $this->accessCacheManager )
        {
            $key = $this->accessCacheManager->getCacheKey();

            $this->accessCacheManager->setCacheAccess( $key, $response );
        }
    }
}