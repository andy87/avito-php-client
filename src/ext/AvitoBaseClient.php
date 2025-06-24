<?php

namespace andy87\avito\client\ext;

use Exception;
use andy87\sdk\client\SdkClient;
use andy87\avito\client\AvitoConfig;
use andy87\sdk\client\base\components\Prompt;
use andy87\sdk\client\core\transport\Response;
use andy87\sdk\client\base\components\Account;
use andy87\avito\client\schema\token\AccessTokenSchema;
use andy87\avito\client\prompts\token\AccessTokenPrompt;

/**
 * Client for Avito API, extending the base client with specific API methods.
 *
 * Тут в методе `authorization` описывается функционал авторизации для получения токена доступа к Avito API.
 *
 * @property AvitoConfig $config
 *
 * @method AvitoRequest constructRequest(Prompt $prompt)
 */
abstract class AvitoBaseClient extends SdkClient
{

    // Errors messages
    private const MESSAGE_INVALID_ACCESS_TOKEN = 'invalid access token';
    private const MESSAGE_BAD_BEARER_TOKEN = 'Bad bearer token';
    private const MESSAGE_ACCESS_TOKEN_EXPIRED = 'access token expired';



    private ?AccessTokenSchema $accessTokenSchema = null;

    /**
     * Проверяет, является ли токен недействительным.
     *
     * @param Response $response Ответ от API, содержащий информацию о токене.
     *
     * @return bool Возвращает true, если токен недействителен, иначе false.
     */
    public function isTokenInvalid( Response $response ): bool
    {
        // чуть позже появятся условия для проверки токена
        $result = $response->getResult();

        if (is_array($result))
        {
            $message = $resp['result']['message'] ?? null;

            return match ($message)
            {
                self::MESSAGE_INVALID_ACCESS_TOKEN, self::MESSAGE_ACCESS_TOKEN_EXPIRED, self::MESSAGE_BAD_BEARER_TOKEN => true,
                default => false,
            };
        }

        return false;
    }

    /**
     * Авторизация для получения токена доступа к Avito API.
     *
     * @param Account $account
     *
     * @return bool
     *
     * @throws Exception
     */
    public function authorization( Account $account ): bool
    {
        if ( $this->modules->cache )
        {
            $this->accessTokenSchema = $this->modules->cache->getData( $account );
        }

        if ( !$this->accessTokenSchema )
        {
            $accessTokenPrompt = new AccessTokenPrompt(
                $account->clientId,
                $account->clientSecret
            );

            $this->accessTokenSchema = $this->getAccessToken($accessTokenPrompt);

            if ( $this->modules->cache )
            {
                $this->modules->cache->setData( $account, $this->accessTokenSchema );
            }
        }

        if ( $this->accessTokenSchema )
        {
            return true;
        }

        $this->errorHandler([
            'method' => __METHOD__,
            'func_get_args' => func_get_args(),
            'accessTokenSchema' => $this->accessTokenSchema
        ]);

        return false;
    }

    /**
     * Получение токена доступа для Avito API.
     *
     * @param AccessTokenPrompt $accessTokenPrompt Объект с данными для запроса токена.
     *
     * @return ?AccessTokenSchema Объект ответа с токеном или null в случае ошибки.
     *
     * @throws Exception
     */
    public function getAccessToken( AccessTokenPrompt $accessTokenPrompt ): ?AccessTokenSchema
    {
        /** @var AccessTokenSchema|null $schema */
        $schema = $this->send( $accessTokenPrompt );

        if ( !$schema )
        {
            $this->errorHandler([
                'method' => __METHOD__,
                'message' => 'Invalid response type',
                'func_get_args' => func_get_args(),
                'response' => $schema
            ]);
        }

        return $schema;
    }
}
