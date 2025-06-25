<?php

namespace andy87\avito\client\operators;

use Exception;
use andy87\avito\client\ext\AvitoAccount;
use andy87\avito\client\schema\auth\AccessTokenSchema;
use andy87\avito\client\prompts\auth\AccessTokenPrompt;
use andy87\avito\client\prompts\auth\AccessTokenCodePrompt;
use andy87\avito\client\prompts\auth\AccessTokenRefreshPrompt;

/**
 * Авторизация
 *
 * С помощью методов из этого раздела вы сможете получить доступ к API,
 * чтобы настроить интеграцию с Авито или пользоваться уже настроенной интеграцией.
 *
 * @documentation https://developers.avito.ru/api-catalog/auth/documentation#ApiDescriptionBlock
 */
final class AuthOperator extends BaseAvitoOperator
{
    /**
     * Получение access token
     * Получения временного ключа для авторизации
     *
     * @documentation https://developers.avito.ru/api-catalog/auth/documentation#operation/getAccessToken
     *
     * @param string $clientId
     * @param string $clientSecret
     *
     * @return null|AccessTokenSchema
     *
     * @throws Exception
     */
    public function getAccessToken( string $clientId, string $clientSecret ): ?AccessTokenSchema
    {
        $accessTokenPrompt = new AccessTokenPrompt( $clientId, $clientSecret );

        /** @var null|AccessTokenSchema $accessTokenSchema */
        $accessTokenSchema = $this->client->send( $accessTokenPrompt );

        return $accessTokenSchema;
    }

    /**
     * Получение access token
     * Получения временного ключа для авторизации запроса от лица пользователя
     *
     * @documentation https://developers.avito.ru/api-catalog/auth/documentation#operation/getAccessTokenAuthorizationCode
     *
     * @param string $clientId
     * @param string $clientSecret
     * @param string $code
     *
     * @return null|AccessTokenSchema
     *
     * @throws Exception
     */
    public function getAccessTokenAuthorizationCode( string $clientId, string $clientSecret, string $code ): ?AccessTokenSchema
    {
        $accessTokenCodePrompt = new AccessTokenCodePrompt( $clientId, $clientSecret, $code );

        /** @var null|AccessTokenSchema $accessTokenSchema */
        $accessTokenSchema = $this->client->send( $accessTokenCodePrompt );

        return $accessTokenSchema;
    }

    /**
     * Обновление access token
     * Обновление временного ключа для авторизации запроса от лица пользователя
     *
     * @documentation https://developers.avito.ru/api-catalog/auth/documentation#operation/refreshAccessTokenAuthorizationCode
     *
     * @param string $clientId
     * @param string $clientSecret
     * @param string $refresh_token
     *
     * @return null|AccessTokenSchema
     *
     * @throws Exception
     */
    public function refreshAccessTokenAuthorizationCode( string $clientId, string $clientSecret, string $refresh_token ): ?AccessTokenSchema
    {
        $accessTokenRefreshPrompt = new AccessTokenRefreshPrompt( $clientId, $clientSecret, $refresh_token );

        /** @var null|AccessTokenSchema $accessTokenSchema */
        $accessTokenSchema = $this->client->send( $accessTokenRefreshPrompt );

        return $accessTokenSchema;
    }
}