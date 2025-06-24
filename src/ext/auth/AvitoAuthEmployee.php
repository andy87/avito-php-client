<?php

namespace andy87\avito\client\ext\auth;

use Exception;
use andy87\avito\client\AvitoClient;
use andy87\sdk\client\base\AbstractClient;
use andy87\sdk\client\core\transport\Query;
use andy87\sdk\client\base\interfaces\AuthorizationInterface;

/**
 * Класс реализует добавление заголовка авторизации для запросов к API Avito.
 *
 * @package src/ext/auth
 */
final class AvitoAuthEmployee implements AuthorizationInterface
{
    /**
     * @throws Exception
     */
    public function run( AvitoClient|AbstractClient $client, Query $query ): void
    {
        $query->addCustomHeaders([ 'X-Employee' => 'true' ] );
    }
}