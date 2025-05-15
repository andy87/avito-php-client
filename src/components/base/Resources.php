<?php declare(strict_types=1);

namespace andy87\avito\client\components\base;

/**
 * Class Resources
 *
 * Класс с логикой построения объекта
 *
 * @package src\components\base
 */
abstract class Resources
{
    /**
     * @example [
     *  'foo' => FooClassName::class, // ... simple class
     *  'bar' => BarClassName::class, // ...instance of Resources
     *  'next' => [ NextClassName::class ], // ... simple class
     *  'third' => [ ThirdClassName::class ], // ... instance of Resources
     *  'entity' => 'some text', // ... simple mix value
     * ]
     * @var Resources[]
     */
    public const MAPPING = [];



    /**
     * Цикл обработки и установки свойств объекта
     *
     * @param array $properties
     *
     * @return void
     */
    public function setupProperties( array $properties ): void
    {
        if ( count( $properties ) > 0 )
        {
            foreach ( $properties as $property => $data )
            {
                if ( property_exists( $this, $property ) )
                {
                    $classConfig = static::MAPPING[ $property ] ?? null;

                    $this->{$property} = ( $classConfig ) ? $this->prepareValue( $classConfig, $data ) : $data;
                }
            }
        }
    }

    /**
     * Подготовка значения свойства для установки в объект
     * с учётом его типа и возможного рекурсивного создания объектов
     *
     * @param mixed $classConfig
     * @param mixed $data
     *
     * @return mixed
     */
    private function prepareValue( mixed $classConfig, mixed $data ): mixed
    {
        if ( $classConfig instanceof Resources )
        {
            $value = new $classConfig();

            $value->setupProperties( $data );

        } elseif( is_array( $classConfig ) ) {

            $className = array_shift( $classConfig );

            $value = [];

            foreach ( $data as $item ) {

                if ( $className instanceof Resources )
                {
                    $object = new $className();
                    $object->setupProperties( $item );

                } else {

                    $object = new $className($item);
                }

                $value[] = $object;
            }

        } elseif ( is_string( $classConfig ) && class_exists( $classConfig ) ) {

            $value = new $classConfig($data);

        } else {

            $value = $classConfig;
        }

        return $value;
    }
}