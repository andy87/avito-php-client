<?php declare(strict_types=1);

namespace andy87\avito\client\components\base;

use CurlHandle;

/**
 * Class Params
 *
 * @package src\components\base
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