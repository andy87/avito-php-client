<?php declare(strict_types=1);

namespace andy87\avito\client\yii2;

use Yii;
use andy87\avito\client\Client;
use andy87\avito\client\components\base\Request;
use andy87\avito\client\components\resources\token\Token;
use andy87\avito\client\components\resources\token\TokenResponse;

/**
 * Class AvitoYii2Api
 *
 * @package app\components\sdk\sdkAvito
 */
class AvitoClient extends Client
{
    public Token $token;



    /**
     * @return ?TokenResponse
     */
    public function authorization(): ?TokenResponse
    {
        return $this->getAccessTokenAuthorizationCode( $this->token );
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