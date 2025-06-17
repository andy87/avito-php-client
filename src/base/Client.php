<?php

namespace andy87\avito\client\base;

use andy87\avito\client\Config;
use andy87\sdk\client\base\Account;
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
     * @param Account $account
     *
     * @return bool
     */
    public function authorization( Account $account ): bool
    {
        $accessTokenPrompt = new AccessTokenPrompt(
            $account->clientId,
            $account->clientSecret
        );

        if ( $this->modules->cache )
        {
            $this->accessTokenSchema = $this->modules->cache->getData( $account, $this->accessTokenSchema );
        }

        if ( !$this->accessTokenSchema )
        {
            $this->accessTokenSchema = $this->getAccessToken($accessTokenPrompt);

            if ( $this->modules->cache )
            {
                $this->modules->cache->setData( $this->accessTokenSchema );
            }
        }

        if ( $this->accessTokenSchema )
        {
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
