<?php

namespace andy87\avito\client\schema\token;

use andy87\sdk\client\base\Schema;

/**
 * Схема ожидаемого ответа от API.
 */
class AccessTokenSchema extends Schema
{
    /** @var string $accessToken OAuth access token string. */
    public string $accessToken;

    /** @var ?int $expiresIn Token expiration time in seconds (if provided). */
    public ?int $expiresIn;
}
