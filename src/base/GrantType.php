<?php

namespace andy87\avito\client\base;

abstract class GrantType
{
    public const GRANT_TYPE_CLIENT_CREDENTIALS = 'client_credentials';

    public const GRANT_TYPE_AUTHORIZATION_CODE = 'authorization_code';

    public const GRANT_TYPE_REFRESH = 'refresh_token';
}