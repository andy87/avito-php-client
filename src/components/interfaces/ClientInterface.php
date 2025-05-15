<?php

namespace andy87\avito\client\components\interfaces;

use andy87\avito\client\components\resources\TokenResponse;

/**
 * Interface ClientInterface
 *
 * @package src\components\interfaces
 */
interface ClientInterface
{
    /**
     * @param string $grantType
     *
     * @return ?TokenResponse
     */
    public function authorization( string $grantType ): ?TokenResponse;

    /**
     * @param array $data
     *
     * @return void
     */
    public function errorHandler( array $data ): void;
}