<?php declare(strict_types=1);

namespace andy87\avito\client\components;

/**
 * @documentation https://developers.avito.ru/api-catalog/auth/documentation#operation/getAccessTokenAuthorizationCode
 *
 * @documentation https://developers.avito.ru/api-catalog/auth/documentation#operation/getAccessToken
 */
abstract class Authorization
{
    /** @var string  */
    public const AUTHORIZATION_CODE = 'authorization_code';

    /** @var string  */
    public const CLIENT_CREDENTIALS = 'client_credentials';
}