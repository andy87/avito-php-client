<?php declare(strict_types=1);

namespace andy87\avito\client\components\base;

use andy87\avito\client\components\Authorization;
use andy87\avito\client\components\interfaces\CacheManagerInterface;

/**
 * Class Sdk
 *
 * @package src\components\base
 */
abstract class Root
{
    /** @var string  */
    public string $requestClass = Request::class;

    /** @var ?CacheManagerInterface */
    public ?CacheManagerInterface $accessCacheManager = null;



    /**
     * @param Params $params
     * 
     * @return Response
     */
    protected function send( Params $params ): Response
    {
        $request = $this->constructRequest( $params );

        /** @var ?Response $response */
        $this->curlHandler( $request );

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
        $className = $this->requestClass;

        return new $className( $params, $responseClass );
    }

    /**
     * @param Request $request
     * 
     * @return ?Response
     */
    protected function curlHandler( Request $request ): ?Response
    {
        $request->constructCurlHandler();

        if ( $this->accessCacheManager ) {
            $this->prepareAuthorization( $request, $this->accessCacheManager->getCacheKey() );
        }

        $request->query();

        $response = $this->constructResponse( $request );

        $this->prepareCurlInfo( $request, $response );

        $request->closeCurl();

        if ( $response->validate() ) return $response;

        $this->errorHandler( $request );

        return null;
    }

    /**
     * @param Request $request
     * @param string $cacheKey
     * 
     * @return void
     */
    public function prepareAuthorization( Request $request, string $cacheKey ): void
    {
        switch ( $request->params->authorization )
        {
            case Authorization::ACCESS_TOKEN:

                $tokenResponse = $this->accessCacheManager->getCacheAccess( $cacheKey );

                $request->updateHeaders([
                    'Authorization' => "Bearer $tokenResponse->access_token",
                ]);
                break;

            case Authorization::CLIENT_CREDENTIALS:
            case Authorization::AUTHORIZATION_CODE:
            default:
                break;
        }
    }

    /**
     * @param Request $request
     *
     * @return Response
     */
    protected function constructResponse( Request $request  ): Response
    {
        $responseClass = $request->getResponseClass();

        /** @var Response $response */
        $response = new $responseClass();

        $response->setupProperties( $request->getResponse() );

        return $response;
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
     * @param Request $request
     *
     * @return void
     */
    abstract public function errorHandler( Request $request ): void;
}