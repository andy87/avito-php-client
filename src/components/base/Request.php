<?php declare(strict_types=1);

namespace andy87\avito\client\components\query;

use CurlHandle;
use andy87\avito\client\components\resources\Params;

/**
 * Class Request
 *
 * @package app\components\sdk\sdkAvito\base\query
 */
final class Request extends Query
{
    public Params $params;


    protected CurlHandle $curl;


    protected int $httpCode = 200;

    protected ?string $content = null;

    protected ?string $errors = null;


    protected string $responseClass;

    protected array $response = [];


    /**
     * @param Params $params
     * @param ?string $responseClass
     */
    public function __construct( Params $params, ?string $responseClass = null )
    {
        $this->prepareProperty($params);

        $this->responseClass = $responseClass ?? $params::RESPONSE_CLASS;
    }

    /**
     * @param Params $params
     *
     * @return void
     */
    private function prepareProperty( Params $params ): void
    {
        $this->endpoint = $params->endpoint;
        $this->method = $params->method;
        $this->headers = $params->headers;
        $this->data = $params->data;
    }

    /**
     * @return void
     */
    public function query(): void
    {
        $this->content = curl_exec($this->curl);

        $this->httpCode = curl_getinfo($this->curl, CURLINFO_HTTP_CODE);

        $this->errors = curl_error($this->curl);
    }

    /**
     * @return void
     */
    public function constructCurlHandler(): void
    {
        $ch = curl_init();

        $this->curl = $this->params->prepareCurlHandler($ch);
    }

    /**
     * @param array $headers
     *
     * @return void
     */
    public function updateHeaders( array $headers ): void
    {
        foreach ($headers as $key => $value )
        {
            $this->headers[$key] = $value;
        }
    }

    /**
     * @param array $options
     *
     * @return void
     */
    public function prepareCurlInfo( array $options ): void
    {
        foreach ($options as $option) {
            $this->curlInfo[$option] = curl_getinfo( $this->curl, $option );
        }
    }

    /**
     * @return string
     */
    public function getResponseClass(): string
    {
        return $this->responseClass;
    }

    /**
     * @return array
     */
    public function getResponse(): array
    {
        return $this->response;
    }

    /**
     * @return ?array
     */
    public function getCurlInfo(): ?array
    {
        return $this->curlInfo;
    }

    /**
     * @return void
     */
    public function closeCurl(): void
    {
        curl_close($this->curl);
    }
}