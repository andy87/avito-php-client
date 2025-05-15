<?php declare(strict_types=1);

namespace andy87\avito\client\components\base;

use Exception;
use andy87\avito\client\prompts\Token;
use andy87\avito\client\components\GrandType;
use andy87\avito\client\components\Authorization;
use andy87\avito\client\prompts\ApplicationsWebhook;
use andy87\avito\client\components\resources\dto\Error;
use andy87\avito\client\components\clients\ClientLogic;
use andy87\avito\client\components\resources\TokenResponse;
use andy87\avito\client\components\interfaces\RequestInterface;

/**
 * Class Operator
 *
 * Класс с функционалом отправки запросов
 *
 * Для работы с классом создайте свой класс, который будет наследоваться от него.
 * В классе потомке переопределите свойство `$classRequest`
 *
 * @package src\components\base
 */
abstract class Operator
{
    /** @var Request|string  */
    public Request|string $classRequest;

    /** @var ?string $url */
    public ?string $access_token = null;


    /** @var ClientLogic $client; */
    protected ClientLogic $client;



    /**
     * @param ClientLogic $client
     *
     * @return void
     */
    public function setClient( ClientLogic $client ): void
    {
        $this->client = $client;
    }

    /**
     * @param Prompt $params
     * @return Response
     *
     * @throws Exception
     * @see Token, ApplicationsWebhook, ApplicationsGetIds, ApplicationsGetByIds
     *
     */
    public function send( Prompt $params ): Response
    {
        $request = $this->constructRequest( $params, $params::RESPONSE_CLASS );

        /** @var ?Response $response */
        $response = $this->requestHandler( $request );

        return $response;
    }

    /**
     * @param Prompt $params
     * @param string $responseClass
     *
     * @return RequestInterface|Request
     */
    protected function constructRequest(Prompt $params, string $responseClass ): RequestInterface|Request
    {
        $className = $this->classRequest;

        return new $className( $params, $responseClass );
    }

    /**
     * @param Request $request
     *
     * @return ?Response
     *
     * @throws Exception
     */
    protected function requestHandler( Request $request ): ?Response
    {
        $request->openConnect();

        $this->prepareAuthorization( $request, $this->client->accessCacheManager->getCacheKey() );

        $request->call();

        $response = $this->constructResponse( $request );

        $this->prepareCurlInfo( $request, $response );

        $request->closeConnect();

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
        if ($request->prompt->authorization === Authorization::ACCESS_TOKEN )
        {
            if ( $this->access_token == null )
            {
                $tokenResponse = ( $this->client->accessCacheManager )
                    ? $this->client->accessCacheManager->getCacheAccess( $cacheKey )
                    : $this->authorization( GrandType::CLIENT_CREDENTIALS );

                if ( $tokenResponse instanceof TokenResponse )
                {
                    $this->access_token = $tokenResponse->access_token;
                }
            }

            if ( $this->access_token )
            {
                $request->updateHeaders([
                    'Authorization' => "Bearer $this->client->access_token",
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
    protected function constructResponse(Request $request ): Response
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
    private function prepareResponse(Request $request, Response $response ): ?Response
    {
        if ( $this->findErrors( $request, $response ) )
        {
            if ( $this->isTokenError( $response ) )
            {
                $this->client->access_token = null;

                $request->closeConnect();

                $this->reconnect( GrandType::CLIENT_CREDENTIALS );

                if ( $this->client->access_token )
                {
                    return $this->send($request->prompt);

                } else {

                    $this->errorHandler([
                        'request' => (array) $request,
                        'response' => (array) $response
                    ]);

                    return null;
                }
            } else {

                $this->errorHandler([
                    'request' => (array) $request,
                    'response' => (array) $response
                ]);

                return null;
            }
        }

        return $response;
    }

    /**
     * @param Request $request
     * @param Response $response
     *
     * @return bool
     *
     * @throws Exception
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

        if ( $this->isTokenError($response) )
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
    private function isTokenError(Response $response ): bool
    {
        if ( $response->error->code === 401 ) return true;

        if ( in_array( $response->error->message, Error::RECONNECT_MESSAGE) ) return true;

        return false;
    }

    /**
     * @param Request $request
     * @param Response $response
     *
     * @return void
     */
    private function prepareCurlInfo(Request $request, Response $response): void
    {
        if ( $curlInfo = $request->getCurlInfo() )
        {
            $request->prepareParams( $curlInfo );

            $response->setCurlInfo( $request->getCurlInfo() );
        }
    }

    /**
     * Процесс проверки метода запроса с корректировкой
     *
     * @param string $method
     * @param Prompt $params
     *
     * @return Prompt
     */
    public function prepareMethod( string $method, Prompt $params ): Prompt
    {
        if ( $params->getMethod() !== $method ) {
            $params->setMethod( $method );
        }

        return $params;
    }

    /**
     * Устанавливает новый access token
     *  + заменяет старый cache
     *
     * @throws Exception
     */
    protected function reconnect( string $grantType ): void
    {
        $tokenResponse = $this->authorization( $grantType );

        if ( $tokenResponse instanceof TokenResponse )
        {
            $this->access_token = $tokenResponse->access_token;

            $this->client->setCache( $tokenResponse );

        } else {

            $this->errorHandler([
                'datetime' => date('Y-m-d H:i:s'),
                'token' => (array) $this->client->token,
                'response' => (array) $tokenResponse,
            ]);
        }
    }

    /**
     * @throws Exception
     */
    protected function authorization( string $grantType ): ?TokenResponse
    {
        return $this->client->authorization($grantType);
    }

    /**
     * @param array $data
     *
     * @return void
     */
    protected function errorHandler( array $data ): void
    {
        $this->client->errorHandler( $data );
    }
}