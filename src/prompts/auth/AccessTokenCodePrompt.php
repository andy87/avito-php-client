<?php

namespace andy87\avito\client\prompts\auth;

use andy87\avito\client\AvitoClient;
use andy87\avito\client\utils\GrantType;

/**
 * Получение access token
 *
 * Получения временного ключа для авторизации запроса от лица пользователя
 *
 * @documentation https://developers.avito.ru/api-catalog/auth/documentation#operation/getAccessTokenAuthorizationCode
 *
 * @package src/prompts/auth/token
 */
class AccessTokenCodePrompt extends AccessTokenPrompt
{
    public string $code;

    public string $grant_type = GrantType::AUTHORIZATION_CODE;



    /**
     * @param string $client_id
     * @param string $client_secret
     * @param string $code
     */
    public function __construct(string $client_id, string $client_secret, string $code )
    {
        $this->code = $code;

        parent::__construct( $client_id, $client_secret );
    }
}
