<?php

namespace andy87\avito\client\prompts\auth;

use andy87\avito\client\AvitoClient;
use andy87\avito\client\helpers\GrantType;

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

    public string $grantType = GrantType::AUTHORIZATION_CODE;



    /**
     * @param string $clientId
     * @param string $clientSecret
     * @param string $code
     */
    public function __construct( string $clientId, string $clientSecret, string $code )
    {
        $this->code = $code;

        parent::__construct( $clientId, $clientSecret );
    }
}
