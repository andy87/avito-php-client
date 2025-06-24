<?php

namespace andy87\avito\client\operators;

use andy87\avito\client\AvitoClient;

/**
 * Базовый класс для сервисов Avito
 *
 * @package src/services
 */
abstract class BaseAvitoOperator
{
    /** @var AvitoClient $client Клиент Avito */
    protected AvitoClient $client;



    /**
     * Конструктор класса BaseAvitoOperator.
     *
     * @param AvitoClient $client
     */
    public function __construct( AvitoClient $client )
    {
        $this->client = $client;
    }
}