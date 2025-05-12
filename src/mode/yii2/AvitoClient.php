<?php declare(strict_types=1);

namespace andy87\avito\client\yii2;

use andy87\avito\client\components\interfaces\CacheManagerInterface;
use Yii;
use andy87\avito\client\Client;
use andy87\avito\client\data\Token;
use andy87\avito\client\components\GrandType;
use andy87\avito\client\components\base\Request;
use andy87\avito\client\components\response\TokenResponse;

/**
 * Class AvitoYii2Api
 *
 * @package app\components\sdk\sdkAvito
 */
class AvitoClient extends Client
{
    public Token $token;


    /**
     * @param string $grantType Тип авторизации
     * @param bool $useCache Метка для использования кэша
     *
     * @return ?TokenResponse
     */
    public function authorization( string $grantType, bool $useCache = true ): ?TokenResponse
    {
        $tokenResponse = match ($grantType)
        {
            GrandType::CLIENT_CREDENTIALS => $this->getAccessToken( $this->token ),
            GrandType::AUTHORIZATION_CODE => $this->getAccessTokenAuthorizationCode( $this->token ),
            GrandType::REFRESH_TOKEN => $this->refreshAccessTokenAuthorizationCode( $this->token ),
        };

        if ( $tokenResponse->validate() )
        {
            if ( $useCache && $this->accessCacheManager )
            {
                $key = $this->accessCacheManager->getCacheKey();

                $this->accessCacheManager->setCacheAccess( $key, $tokenResponse );
            }

            return $tokenResponse;
        }

        \Yii::error([
            'datetime' => date('Y-m-d H:i:s'),
            '$grantType' => $grantType,
            'token' => $this->token,
            'request' => $tokenResponse
        ]);

        return null;
    }

    /**
     * @param string $client_id
     * @param string $client_secret
     *
     * @return static
     */
    public function setupToken( string $client_id, string $client_secret ): static
    {
        $token = new Token( $client_id, $client_secret );

        $this->token = $token;

        return $this;
    }

    /**
     * @param Request $request
     *
     * @return void
     */
    public function errorHandler( Request $request ): void
    {
        Yii::error([
            'datetime' => date('Y-m-d H:i:s'),
            'request' => $request,
        ]);
    }
}