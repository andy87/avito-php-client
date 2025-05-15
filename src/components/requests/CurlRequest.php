<?php declare(strict_types=1);

namespace andy87\avito\client\components\requests;

use CurlHandle;
use andy87\avito\client\components\base\Prompt;
use andy87\avito\client\components\base\Request;

/**
 * Class Request
 *
 * @package src\components\requests
 */
class CurlRequest extends Request
{
    protected ?CurlHandle $curl = null;

    protected string $responseClass;



    /**
     * @param Prompt $params
     * @param string $responseClass
     */
    public function __construct(Prompt $params, string $responseClass )
    {
        $this->prepareProperty($params);

        $this->responseClass = $responseClass;
    }

    /**
     * @param Prompt $params
     *
     * @return void
     */
    private function prepareProperty(Prompt $params ): void
    {
        $this->endpoint = $params->endpoint;

        $this->method = $params->method;

        $this->headers = $params->headers;

        $this->data = $params->data;
    }

    /**
     * @return void
     */
    public function openConnect(): void
    {
        $ch = curl_init();

        $this->curl = $this->prompt->prepareCurlHandler($ch);
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
     * @return void
     */
    public function call(): void
    {
        $this->content = curl_exec( $this->curl );

        $this->response = json_decode( $this->content, true );

        $this->httpCode = curl_getinfo( $this->curl, CURLINFO_HTTP_CODE );

        $this->errors = curl_error( $this->curl );
    }

    /**
     * @return void
     */
    public function closeConnect(): void
    {
        if ($this->curl) curl_close($this->curl);
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
        return $this->params;
    }

    /**
     * @param array $options
     *
     * @return void
     */
    public function prepareParams( array $options ): void
    {
        foreach ($options as $option) {
            $this->params[$option] = curl_getinfo( $this->curl, $option );
        }
    }
}