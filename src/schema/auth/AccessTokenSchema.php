<?php

namespace andy87\avito\client\schema\auth;

use andy87\sdk\client\base\components\Schema;

/**
 * Схема ожидаемого ответа от API.
 *
 * @documentation
 *  - https://developers.avito.ru/api-catalog/auth/documentation#operation/getAccessToken
 *  - https://developers.avito.ru/api-catalog/auth/documentation#operation/getAccessTokenAuthorizationCode
 *  - https://developers.avito.ru/api-catalog/auth/documentation#operation/refreshAccessTokenAuthorizationCode
 *
 * @package src/schema/auth
 */
final class AccessTokenSchema extends Schema
{
    /**
     * @var string $access_token
     *
     * Example: "5dFy4pHbgwcANQwe9tqhCk"
     */
    public string $access_token;

    /**
     * @var null|int $expires_in
     *
     * Example: 86400
     */
    public ?int $expires_in;

    /**
     * @var string
     *
     * Example: "5dFy4pHbgwcANQwe9tqhCkHbgwcANQHbgwcANQ"
     */
    public string $refresh_token;


    /**
     * @var string
     *
     * Example: "messenger:read,messenger:write"
     */
    public string $scope;

    /**
     * @var string
     *
     * Example: "Bearer"
     */
    public string $token_type;
}
