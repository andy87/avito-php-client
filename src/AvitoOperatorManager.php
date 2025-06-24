<?php

namespace andy87\avito\client;

use Exception;
use andy87\avito\client\ext\AvitoBaseClient;
use andy87\avito\client\operators\JobOperator;
use andy87\avito\client\operators\AuthOperator;
use andy87\avito\client\operators\AutoloadOperator;
use andy87\avito\client\operators\AccountsHierarchyOperator;

/**
 * Динамический менеджер сервисов Avito
 *
 * @property AccountsHierarchyOperator $accountsHierarchyOperator
 * @property AuthOperator $authOperator
 * @property AutoloadOperator $autoloadOperator
 * @property JobOperator $jobOperator
 *
 * @package src
 */
class AvitoOperatorManager
{
    protected CONST MAP = [
        'accountsHierarchyOperator' => AccountsHierarchyOperator::class,
        'authOperator' => AuthOperator::class,
        'autoloadOperator' => AutoloadOperator::class,
        'jobOperator' => JobOperator::class,
    ];


    /** @var AvitoBaseClient $client Клиент Avito используемый для запросов к API */
    private AvitoBaseClient $client;

    /** @var array $instances Массив для хранения экземпляров сервисов */
    private array $instances = [];



    /**
     * Конструктор класса AvitoServiceManager
     *
     * @param AvitoBaseClient $client
     */
    public function __construct( AvitoBaseClient $client )
    {
        $this->client = $client;
    }



    /**
     * Магический метод для динамического вызова сервисов Avito
     *
     * @param string $name
     * @param array $arguments
     *
     * @return mixed
     *
     * @throws Exception
     */
    public function __call( string $name, array $arguments )
    {
        if ( !isset( $this->instances[$name] ) )
        {
            if ( !isset( self::MAP[$name] ) )
            {
                throw new Exception( "Service '$name' not found." );
            }

            $serviceClass = self::MAP[$name];

            $this->instances[$name] = new $serviceClass( $this->client );
        }

        return $this->instances[$name];
    }
}