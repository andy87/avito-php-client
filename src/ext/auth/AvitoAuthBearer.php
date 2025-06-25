<?php

namespace andy87\avito\client\ext\auth;

use Exception;
use andy87\avito\client\AvitoClient;
use andy87\sdk\client\base\AbstractClient;
use andy87\sdk\client\core\transport\Query;
use andy87\sdk\client\base\interfaces\AuthorizationInterface;

/**
 * Класс реализует авторизацию по Bearer токену для Avito API.
 *
 * @package src/ext/auth
 */
final class AvitoAuthBearer implements AuthorizationInterface
{
    /**
     * @throws Exception
     */
    public function run( AvitoClient|AbstractClient $client, Query $query ): void
    {
        if ( $token = $client->getBearerToken() )
        {
            $query->addCustomHeaders([ 'Authorization' => "Bearer $token" ]);
        }
    }
}