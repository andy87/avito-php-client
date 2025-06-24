<?php

namespace andy87\avito\client\prompts\token;

/**
 * Обновление access token
 * Обновление временного ключа для авторизации запроса от лица пользователя
 *
 * @documentation https://developers.avito.ru/api-catalog/auth/documentation#operation/refreshAccessTokenAuthorizationCode
 *
 * @package src/prompts/token
 */
class AccessTokenRefreshPrompt extends AccessTokenPrompt
{
    public string $refresh_token;
}
