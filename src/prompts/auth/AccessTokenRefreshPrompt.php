<?php

namespace andy87\avito\client\prompts\auth;

use andy87\avito\client\utils\GrantType;

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

    public string $grant_type = GrantType::REFRESH_TOKEN;



    /**
     * @param string $client_id
     * @param string $client_secret
     * @param string $refresh_token
     */
    public function __construct(string $client_id, string $client_secret, string $refresh_token )
    {
        $this->refresh_token = $refresh_token;

        parent::__construct( $client_id, $client_secret );
    }
}
