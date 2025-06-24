<?php

namespace andy87\avito\client\ext;

use Exception;
use andy87\avito\client\AvitoConfig;
use andy87\avito\client\AvitoOperatorManager;
use andy87\avito\client\schema\auth\AccessTokenSchema;
use andy87\sdk\client\SdkClient;
use andy87\sdk\client\core\transport\Response;
use andy87\sdk\client\base\components\Account;
use andy87\sdk\client\base\modules\AbstractCache;
use andy87\sdk\client\base\interfaces\ClientInterface;

/**
 * Client for Avito API, extending the base client with specific API methods.
 *
 * Тут в методе `authorization` описывается функционал авторизации для получения токена доступа к Avito API.
 *
 * @property AvitoConfig $config
 */
abstract class AvitoBaseClient extends SdkClient
{
    // Errors messages
    public const MESSAGE_INVALID_ACCESS_TOKEN = 'invalid access token';
    public const MESSAGE_BAD_BEARER_TOKEN = 'Bad bearer token';
    public const MESSAGE_ACCESS_TOKEN_EXPIRED = 'access token expired';



    public AvitoOperatorManager $operatorManager;

    protected ?AccessTokenSchema $accessTokenSchema = null;



    /**
     * Конструктор
     *
     * @param AvitoConfig $config
     *
     * @throws Exception
     */
    public function __construct( AvitoConfig $config )
    {
        parent::__construct( $config );

        $this->operatorManager = new AvitoOperatorManager( $this );
    }

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
                self::MESSAGE_INVALID_ACCESS_TOKEN,
                self::MESSAGE_ACCESS_TOKEN_EXPIRED,
                self::MESSAGE_BAD_BEARER_TOKEN => true,
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
            $this->accessTokenSchema = $this->operatorManager->authOperator->getAccessToken();

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
}
