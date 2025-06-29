<?php

namespace andy87\avito\client\utils;

/**
 * Класс GrantType
 *
 * Содержет список значений для свойства `grantType` в объекте `AccessTokenPrompt`
 *
 * @package src/helpers
 */
abstract class GrantType
{
    public const CLIENT_CREDENTIALS = 'client_credentials';

    public const AUTHORIZATION_CODE = 'authorization_code';

    public const REFRESH_TOKEN = 'refresh_token';
}