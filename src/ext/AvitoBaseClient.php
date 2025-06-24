<?php

namespace andy87\avito\client\ext;

use andy87\sdk\client\base\interfaces\ClientInterface;
use andy87\sdk\client\base\modules\AbstractCache;
use andy87\sdk\client\base\modules\AbstractLogger;
use andy87\sdk\client\base\modules\AbstractTest;
use andy87\sdk\client\base\modules\AbstractTransport;
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
    public const MESSAGE_INVALID_ACCESS_TOKEN = 'invalid access token';
    public const MESSAGE_BAD_BEARER_TOKEN = 'Bad bearer token';
    public const MESSAGE_ACCESS_TOKEN_EXPIRED = 'access token expired';



    protected ?AccessTokenSchema $accessTokenSchema = null;


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
        /** @var AbstractCache $cache */
        if ( $cache = $this->getModule(ClientInterface::CACHE) )
        {
            $this->accessTokenSchema = $cache->getData( $account );
        }

        if ( !$this->accessTokenSchema )
        {
            $accessTokenPrompt = new AccessTokenPrompt(
                $account->clientId,
                $account->clientSecret
            );

            $this->accessTokenSchema = $this->getAccessToken($accessTokenPrompt);

            if ( $this->accessTokenSchema instanceof AccessTokenSchema )
            {
                $accessTokenSchema = serialize($this->accessTokenSchema);

                $cache->setData( $account, $accessTokenSchema );
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

    /**
     * @return string
     *
     * @throws Exception
     */
    public function getBearerToken(): string
    {
        if ( $this->accessTokenSchema === null )
        {
            if ( $account = $this->getConfig()->getAccount() )
            {
                if ( !$this->authorization($account) )
                {
                    $this->errorHandler([
                        'message' => 'Authorization failed. Please check your client ID and secret.',
                        'client_id' => $account->clientId,
                        'client_secret' => $account->clientSecret,
                    ]);
                }
            }
        }

        return $this->accessTokenSchema->access_token;
    }
}
