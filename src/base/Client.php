<?php

namespace andy87\avito\client\base;

use andy87\avito\client\Config;
use andy87\sdk\client\SdkClient;
use andy87\avito\client\prompts\token\AccessTokenPrompt;
use andy87\avito\client\schema\token\AccessTokenSchema;

/**
 * Client for Avito API, extending the base client with specific API methods.
 *
 * Тут в методе `authorization` описывается функционал авторизации для получения токена доступа к Avito API.
 *
 * @property Config $config
 */
abstract class Client extends SdkClient
{
    private ?AccessTokenSchema $accessTokenSchema = null;



    /**
     * @return bool
     */
    public function authorization(): bool
    {
        $accessTokenPrompt = new AccessTokenPrompt(
            $this->config->account->clientId,
            $this->config->account->clientSecret
        );

        $this->accessTokenSchema = $this->getAccessToken($accessTokenPrompt);

        if ( $this->accessTokenSchema )
        {
            $this->setupCache( $this->accessTokenSchema );

            return true;
        }

        $this->errorHandler([
            'method' => __METHOD__,
            'prompt' => $accessTokenPrompt,
            'accessTokenSchema' => $this->accessTokenSchema
        ]);

        return false;
    }

    /**
     * Получение токена доступа для Avito API.
     *
     * @param AccessTokenPrompt $prompt Объект с данными для запроса токена.
     *
     * @return ?AccessTokenSchema Объект ответа с токеном или null в случае ошибки.
     */
    public function getAccessToken(AccessTokenPrompt $prompt): ?AccessTokenSchema
    {
        $response = $this->send($prompt);

        return ($response instanceof AccessTokenSchema) ? $response :null;
    }

}
