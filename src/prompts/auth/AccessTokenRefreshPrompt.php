<?php

namespace andy87\avito\client\prompts\auth;

use andy87\avito\client\helpers\GrantType;

/**
 * Обновление access token
 * Обновление временного ключа для авторизации запроса от лица пользователя
 *
 * @documentation https://developers.avito.ru/api-catalog/auth/documentation#operation/refreshAccessTokenAuthorizationCode
 *
 * @package src/prompts/auth/token
 */
class AccessTokenRefreshPrompt extends AccessTokenPrompt
{
    public string $refresh_token;

    public string $grantType = GrantType::REFRESH_TOKEN;



    /**
     * @param string $clientId
     * @param string $clientSecret
     * @param string $refresh_token
     */
    public function __construct( string $clientId, string $clientSecret, string $refresh_token )
    {
        $this->refresh_token = $refresh_token;

        parent::__construct( $clientId, $clientSecret );
    }
}
