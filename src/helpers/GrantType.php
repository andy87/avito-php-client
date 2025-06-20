<?php

namespace andy87\avito\client\helpers;

/**
 * Класс GrantType
 *
 * Содержет список значений для свойства `grantType` в объекте `AccessTokenPrompt`
 */
abstract class GrantType
{
    public const CLIENT_CREDENTIALS = 'client_credentials';

    public const AUTHORIZATION_CODE = 'authorization_code';

    public const REFRESH_TOKEN = 'refresh_token';
}