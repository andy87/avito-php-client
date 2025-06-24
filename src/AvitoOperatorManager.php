<?php

namespace andy87\avito\client;

use Exception;
use andy87\avito\client\ext\AvitoBaseClient;
use andy87\avito\client\operators\BaseAvitoOperator;
use andy87\avito\client\operators\JobOperator;
use andy87\avito\client\operators\AuthOperator;
use andy87\avito\client\operators\AutoloadOperator;
use andy87\avito\client\operators\AccountsHierarchyOperator;

/**
 * Явный менеджер операторов Avito.
 * Убирает магические методы. Операторы доступны через get-методы.
 *
 * @property-read AuthOperator $authOperator
 * @property-read JobOperator $jobOperator
 * @property-read AutoloadOperator $autoloadOperator
 * @property-read AccountsHierarchyOperator $accountsHierarchyOperator
 *
 * @package src
 */
class AvitoOperatorManager
{
    /**
     * Список операторов, доступных в менеджере.
     * Ключ - имя оператора, значение - класс оператора.
     *
     * @var array<string, class-string<BaseAvitoOperator>>
     */
    private const MAP = [
        'authOperator' => AuthOperator::class,
        'jobOperator' => JobOperator::class,
        'autoloadOperator' => AutoloadOperator::class,
        'accountsHierarchyOperator' => AccountsHierarchyOperator::class,
    ];



    /** @var AvitoBaseClient $client Клиент Avito, который используется для выполнения запросов. */
    private AvitoBaseClient $client;

    /** @var array $instances Массив для хранения экземпляров операторов. */
    private array $instances = [];


    /**
     * Конструктор класса AvitoOperatorManager.
     *
     * @param AvitoBaseClient $client Клиент Avito, который используется для выполнения запросов.
     *
     * @throws Exception
     */
    public function __construct(AvitoBaseClient $client)
    {
        $this->client = $client;
    }


    /**
     * Магический метод для получения экземпляра оператора по его имени.
     *
     * @param mixed $name Имя оператора.
     *
     * @return BaseAvitoOperator Экземпляр оператора.
     *
     * @throws Exception
     */
    public function __get( mixed $name)
    {
        if (array_key_exists($name, self::MAP))
        {
            $className = self::MAP[$name];

            if (!isset($this->instances[$className]))
            {
                $instance = new $className($this->client);

                if ($instance instanceof BaseAvitoOperator)
                {
                    $this->instances[$className] = $instance;

                } else {

                    throw new Exception("$className must extend BaseAvitoOperator.");
                }
            }

            return $this->instances[$className];
        }
        throw new Exception("Operator '$name' not registered in AvitoOperatorManager.");
    }
}
