<?php declare(strict_types=1);

namespace andy87\avito\client\components\resources\token;


use andy87\avito\client\components\query\Response;

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
 */
final class TokenResponse extends Response
{
    public string $access_token;

    public string $expires_in;

    public string $refresh_token;

    public string $scope;

    public string $token_type;



    /**
     * @return bool
     */
    public function isValid(?string $rules = null): bool
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