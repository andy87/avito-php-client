<?php declare(strict_types=1);

namespace andy87\avito\client\frameworks\yii2;

use Yii;
use andy87\avito\client\Client;
use andy87\avito\client\components\base\Operator;
use andy87\avito\client\components\operators\CurlOperator;

/**
 * Class Yii2AvitoClient
 *
 * Класс с реализацией конкретных методов API
 *
 * @package src\frameworks\yii2
 */
class Yii2AvitoClient extends Client
{
    /** @var string Класс с функционалом отправки запросов */
    public string $classOperator = CurlOperator::class;



    /**
     * Создание экземпляра класса оператора
     *
     * @param string $className
     *
     * @return Operator
     */
    protected function constructOperator( string $className ): Operator
    {
        return Yii::createObject($className);
    }

    /**
     * @param array $data
     *
     * @return void
     */
    public function errorHandler( array $data ): void
    {
        Yii::error($data);

        if ( Yii::$app instanceof \yii\console\Applicatino )
        {
            echo PHP_EOL;
            print_r( $data );
        }
    }
}