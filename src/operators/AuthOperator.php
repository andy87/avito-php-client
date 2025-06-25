<?php

namespace andy87\avito\client\operators;

use Exception;
use andy87\avito\client\schema\dto\Warning;
use andy87\avito\client\schema\auth\AccessTokenSchema;
use andy87\avito\client\prompts\auth\{ AccessTokenPrompt, AccessTokenCodePrompt, AccessTokenRefreshPrompt };

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
     * @param string $client_id
     * @param string $client_secret
     *
     * @return null|AccessTokenSchema
     *
     * @throws Exception
     */
    public function getAccessToken( string $client_id, string $client_secret ): ?AccessTokenSchema
    {
        $accessTokenPrompt = new AccessTokenPrompt( $client_id, $client_secret );

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
     * @param string $client_id
     * @param string $client_secret
     * @param string $code
     *
     * @return null|AccessTokenSchema
     *
     * @throws Exception
     */
    public function getAccessTokenAuthorizationCode(string $client_id, string $client_secret, string $code ): ?AccessTokenSchema
    {
        $accessTokenCodePrompt = new AccessTokenCodePrompt( $client_id, $client_secret, $code );

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
     * @param string $client_id
     * @param string $client_secret
     * @param string $refresh_token
     *
     * @return null|AccessTokenSchema
     *
     * @throws Exception
     */
    public function refreshAccessTokenAuthorizationCode( string $client_id, string $client_secret, string $refresh_token ): ?AccessTokenSchema
    {
        $accessTokenRefreshPrompt = new AccessTokenRefreshPrompt( $client_id, $client_secret, $refresh_token );

        /** @var null|AccessTokenSchema $accessTokenSchema */
        $accessTokenSchema = $this->client->send( $accessTokenRefreshPrompt );

        return $accessTokenSchema;
    }
}