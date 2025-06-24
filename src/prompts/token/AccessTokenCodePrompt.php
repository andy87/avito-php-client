<?php

namespace andy87\avito\client\prompts\token;

/**
 * Получение access token
 *
 * Получения временного ключа для авторизации запроса от лица пользователя
 *
 * @documentation https://developers.avito.ru/api-catalog/auth/documentation#operation/getAccessTokenAuthorizationCode
 *
 * @package src/prompts/token
 */
class AccessTokenCodePrompt extends AccessTokenPrompt
{
    public string $code;
}
