<?php declare(strict_types=1);

namespace andy87\avito\client\components\base;

use andy87\avito\client\components\GrandType;
use andy87\avito\client\components\response\dto\Error;
use Yii;
use Exception;
use andy87\avito\client\data\Token;
use andy87\avito\client\components\Authorization;
use andy87\avito\client\components\response\TokenResponse;
use andy87\avito\client\components\interfaces\CacheManagerInterface;

/**
 * Class Sdk
 *
 * @package src\components\base
 */
abstract class Operator
{
    /** @var string  */
    public const CLASS_REQUEST = Request::class;

    /** @var Token $token */
    public Token $token;

    /** @var ?string $url */
    public ?string $access_token = null;

    /** @var ?CacheManagerInterface */
    public ?CacheManagerInterface $accessCacheManager = null;



    /**
     * @param string $client_id
     * @param string $client_secret
     */
    public function __construct( string $client_id, string $client_secret )
    {
        $this->token = new Token($client_id, $client_secret);
    }

    /**
     * @param Params $params
     *
     * @return Response
     *
     * @throws Exception
     */
    protected function send( Params $params ): Response
    {
        $request = $this->constructRequest( $params );

        /** @var ?Response $response */
        $response = $this->curlHandler( $request );

        return $response;
    }

    /**
     * @param Params $params
     * @param ?string $responseClass
     * 
     * @return Request
     */
    protected function constructRequest( Params $params, ?string $responseClass = null ): Request
    {
        $className = static::CLASS_REQUEST;

        return new $className( $params, $responseClass );
    }

    /**
     * @param Request $request
     *
     * @return ?Response
     *
     * @throws Exception
     */
    protected function curlHandler( Request $request ): ?Response
    {
        $request->constructCurlHandler();

        $this->prepareAuthorization( $request, $this->accessCacheManager->getCacheKey() );

        $request->query();

        $response = $this->constructResponse( $request );

        $this->prepareCurlInfo( $request, $response );

        $request->closeCurl();

        if ( $response->validate() ) return $response;

        $this->errorHandler([
            'request' => (array) $request,
            'response' => (array) $response
        ]);

        return null;
    }

    /**
     * @param Request $request
     * @param string $cacheKey
     *
     * @return void
     *
     * @throws Exception
     */
    public function prepareAuthorization( Request $request, string $cacheKey ): void
    {
        if ($request->params->authorization === Authorization::ACCESS_TOKEN)
        {
            if ( $this->access_token == null )
            {
                $tokenResponse = ( $this->accessCacheManager )
                    ? $this->accessCacheManager->getCacheAccess( $cacheKey )
                    : $this->getAccessToken( $this->token );

                if ( $tokenResponse instanceof TokenResponse )
                {
                    $this->access_token = $tokenResponse->access_token;
                }
            }

            if ( $this->access_token )
            {
                $request->updateHeaders([
                    'Authorization' => "Bearer $this->access_token",
                ]);

            } else {

                throw new Exception('TokenResponse not found');
            }
        }
    }

    /**
     * @param Request $request
     *
     * @return Response
     *
     * @throws Exception
     */
    protected function constructResponse( Request $request ): Response
    {
        $responseClass = $request->getResponseClass();

        /** @var Response $response */
        $response = new $responseClass();

        $response->setupProperties( $request->getResponse() );

        return $this->prepareResponse( $request, $response );
    }

    /**
     * @param Request $request
     * @param Response $response
     *
     * @return ?Response
     *
     * @throws Exception
     */
    private function prepareResponse( Request $request, Response $response ): ?Response
    {
        if ( $this->findErrors( $request, $response ) )
        {
            if ( $this->isNeedReconnect( $response ) )
            {
                $this->access_token = null;

                $request->closeCurl();

                $this->reconnect();

                if ( $this->access_token )
                {
                    return $this->send($request->params);
                }

                $this->errorHandler([
                    'request' => (array) $request,
                    'response' => (array) $response
                ]);
            }
        }

        return $response;
    }

    /**
     * @param Request $request
     * @param Response $response
     *
     * @return bool
     */
    private function findErrors(Request $request, Response $response ): bool
    {
        if ( $response->error->code || $response->error->message )
        {
            $this->errorHandler([
                'request' => $request,
                'response' => $response,
                'error' => (array) $response->error
            ]);

            return true;
        }

        if ($response->result->message)
        {
            $this->errorHandler([
                'request' => $request,
                'response' => $response,
                'result' => (array) $response->result
            ]);

            return true;
        }

        return false;
    }

    /**
     * @param Response $response
     *
     * @return bool
     *
     * @throws Exception
     */
    private function isNeedReconnect(Response $response ): bool
    {
        if ( $response->error->code === 401 ) return true;

        if ( in_array( $response->error->message, Error::RECONNECT_MESSAGE) ) return true;
    }

    /**
     * @throws Exception
     */
    private function reconnect(): void
    {
        $tokenResponse = $this->getAccessToken( $this->token );

        if ($tokenResponse instanceof TokenResponse )
        {
            $this->access_token = $tokenResponse->access_token;

            $this->setCache( $tokenResponse );

        } else {

            $this->errorHandler( [
                'datetime' => date('Y-m-d H:i:s'),
                'token' => (array) $this->token,
                'response' => (array) $tokenResponse,
            ]);
        }
    }

    /**
     * @param Request $request
     * @param Response $response
     *
     * @return void
     */
    private function prepareCurlInfo( Request $request, Response $response): void
    {
        if ( $curlInfo = $request->getCurlInfo() )
        {
            $request->prepareCurlInfo( $curlInfo );

            $response->setCurlInfo( $request->getCurlInfo() );
        }
    }

    /**
     * Получение access token
     * Получения временного ключа для авторизации
     *
     * @documentation https://developers.avito.ru/api-catalog/auth/documentation#operation/getAccessToken
     *
     * @param Token $token
     *
     * @return ?TokenResponse
     *
     * @throws Exception
     */
    public function getAccessToken( Token $token ): ?TokenResponse
    {
        $token->grant_type = GrandType::CLIENT_CREDENTIALS;

        /** @var ?TokenResponse $response */
        $response = $this->send( $token );

       $this->setCache( $response );

        return $response;
    }

    /**
     * @param $response
     *
     * @return void
     */
    private function setCache($response): void
    {
        if ( $this->accessCacheManager )
        {
            $key = $this->accessCacheManager->getCacheKey();

            $this->accessCacheManager->setCacheAccess( $key, $response );
        }
    }

    /**
     * @param array $data
     *
     * @return void
     */
    abstract public function errorHandler( array $data ): void;
}