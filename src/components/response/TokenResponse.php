<?php declare(strict_types=1);

namespace andy87\avito\client\components\response;

use andy87\avito\client\components\base\Response;

/**
 * @documentation https://developers.avito.ru/api-catalog/auth/documentation#operation/getAccessTokenAuthorizationCode
 *
 * Получение access token
 * Получения временного ключа для авторизации запроса от лица пользователя
 *
 * Example:
 * {
 *      "access_token": "kChqt9ewQNAcwgbHp4yFd5",
 *      "expires_in": 86400,
 *      "refresh_token": "QNAcwgbHQNAcwgbHkChqt9ewQNAcwgbHp4yFd5",
 *      "scope": "messenger:read,messenger:write",
 *      "token_type": "Bearer"
 * }
 *
 * @package src\components\resources\token
 */
final class TokenResponse extends Response
{
    /**
     * @example "5dFy4pHbgwcANQwe9tqhCk"
     *
     * @var string
     */
    public string $access_token;

    /**
     * @example 86400
     *
     * @var string
     */
    public string $expires_in;

    /**
     * @example "5dFy4pHbgwcANQwe9tqhCkHbgwcANQHbgwcANQ"
     *
     * @var string
     */
    public string $refresh_token;

    /**
     * @example "messenger:read,messenger:write"
     *
     * @var string
     */
    public string $scope;

    /**
     * @example "Bearer"
     *
     * @var string
     */
    public string $token_type;



    /**
     * @param string|null $rules
     *
     * @return bool
     */
    public function validate(?string $rules = null): bool
    {
        if ( empty($this->access_token) || empty($this->expires_in) ) {
            return false;
        }

        if ( $this->expires_in < 0 ) {
            return false;
        }

        return true;
    }
}