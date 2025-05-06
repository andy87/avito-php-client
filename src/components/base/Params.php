<?php declare(strict_types=1);

namespace andy87\avito\client\components\resources;

use CurlHandle;
use andy87\avito\client\components\query\Query;
use andy87\avito\client\components\query\Response;

/**
 * Class Params
 *
 * @package app\components\sdk\sdkAvito\base\resources
 */
abstract class Params extends Query
{
    /** @var string  */
    public const RESPONSE_CLASS = Response::class;

    public ?string $authorization = null;



    /**
     * @return array
     */
    public function release(): array
    {
        return (array) $this;
    }

    /**
     * @param CurlHandle $ch
     *
     * @return CurlHandle
     */
    public function prepareCurlHandler( CurlHandle $ch ): CurlHandle
    {
        return $ch;
    }
}