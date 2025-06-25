<?php

namespace andy87\avito\client\ext;

use Exception;
use andy87\avito\client\AvitoConfig;
use andy87\avito\client\utils\Invalid;
use andy87\avito\client\schema\auth\AccessTokenSchema;
use andy87\sdk\client\SdkClient;
use andy87\sdk\client\core\transport\Response;
use andy87\sdk\client\base\components\Account;
use andy87\sdk\client\base\interfaces\ClientInterface;

/**
 * Client for Avito API, extending the base client with specific API methods.
 *
 * Тут в методе `authorization` описывается функционал авторизации для получения токена доступа к Avito API.
 *
 * @property AvitoConfig $config
 *
 * @package src\ext
 */
abstract class AvitoBaseClient extends SdkClient
{
    /**
     * @var null|AccessTokenSchema Кэшированная схема токена доступа.
     */
    protected ?AccessTokenSchema $accessTokenSchema = null;



    /**
     * Проверяет, является ли токен недействительным.
     *
     * @param Response $response Ответ от API, содержащий информацию о токене.
     *
     * @return bool Возвращает true, если токен недействителен, иначе false.
     *
     * @throws Exception
     */
    public function isTokenInvalid( Response $response ): bool
    {
        // чуть позже появятся условия для проверки токена
        $result = $response->getResult();

        $status = $result['result']['status'] ?? null;

        if (is_array($result) && $status === false )
        {
            $message = $result['result']['message'] ?? null;

            return match ($message)
            {
                Invalid::MESSAGE_INVALID_ACCESS_TOKEN,
                Invalid::MESSAGE_ACCESS_TOKEN_EXPIRED,
                Invalid::MESSAGE_BAD_BEARER_TOKEN => true,
                default => false,
            };

        } else {
            $this->errorHandler([
                'method' => __METHOD__,
                'message' => 'Response result is not an array.',
                'response' => $response,
            ]);
        }

        return false;
    }

    /**
     * Авторизация для получения токена доступа к Avito API.
     *
     * @param Account $account
     * @param bool $useCache
     *
     * @return bool
     *
     * @throws Exception
     */
    public function authorization( Account $account, bool $useCache = true ): bool
    {
        $this->accessTokenSchema = null;

        $cache = $this->getModule( ClientInterface::CACHE );

        if ( $useCache && $cache )
        {
            $this->accessTokenSchema = $cache->getCacheAccessTokenSchema( $account );
        }

        if ( !$this->accessTokenSchema )
        {
            if ( $this->accessTokenSchema = $this->getAccessToken() )
            {
                if ( $useCache && $cache ) $cache->setData( $account, $this->accessTokenSchema );
            }
        }

        if ( !$this->accessTokenSchema )
        {
            $this->errorHandler([
                'method' => __METHOD__,
                'message' => 'Access token schema is null.',
                'func_get_args' => func_get_args(),
            ]);
        }

        return ( $this->accessTokenSchema instanceof AccessTokenSchema );
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
            $this->accessTokenSchema = $this->getCacheAccessTokenSchema();

            if ( !$this->accessTokenSchema )
            {
                if ($account = $this->getConfig()->getAccount())
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
        }

        return $this->accessTokenSchema->access_token;
    }

    /**
     * Получение access token из кэша.
     *
     * @return null|AccessTokenSchema
     *
     * @throws Exception
     */
    public function getCacheAccessTokenSchema(): ?AccessTokenSchema
    {
        $accessTokenSchema = null;

        if ( $cache = $this->getModule( ClientInterface::CACHE ) )
        {
            $data = $cache->getData( $this->getConfig()->getAccount() );

            $accessTokenSchema = unserialize( $data, ['allowed_classes' => [AccessTokenSchema::class]] );
        }

        return $accessTokenSchema;
    }

    /**
     * Получение AccessTokenSchema.
     *
     * @return null|AccessTokenSchema
     *
     * @throws Exception
     */
    abstract public function getAccessToken(): ?AccessTokenSchema;
}
