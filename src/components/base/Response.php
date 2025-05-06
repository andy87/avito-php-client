<?php declare(strict_types=1);

namespace andy87\avito\client\components\query;

use andy87\avito\client\components\resources\Resources;

/**
 * Class Response
 *
 * @package app\components\sdk\sdkAvito\base\query
 */
abstract class Response extends Resources
{
    /** @var array  */
    protected array $curlInfo = [];


    /**
     * @param array $curlInfo
     *
     * @return void
     */
    public function setCurlInfo( array $curlInfo ): void
    {
        $this->curlInfo = $curlInfo;
    }

    /**
     * @return array
     */
    public function getCurlInfo(): array
    {
        return $this->curlInfo;
    }

    /**
     * @param array $properties
     *
     * @return void
     */
    public function setupProperties( array $properties ): void
    {
        if ( count($properties) > 0 )
        {
            foreach ($properties as $property => $value )
            {
                if ( property_exists($this, $property) )
                {
                    $this->{$property} = $value;
                }
            }
        }
    }

    /**
     * @return array
     */
    public function asArray(): array
    {
        return (array) $this;
    }

    /**
     * @param ?string $rules
     *
     * @return bool
     */
    abstract public function isValid( ?string $rules = null ): bool;
}