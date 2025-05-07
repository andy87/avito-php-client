<?php declare(strict_types=1);

namespace andy87\avito\client\components\base;



/**
 * Class Request
 *
 * @package src\components\base
 */
abstract class Query
{
    public const GET = 'GET';
    public const POST = 'POST';
    public const PUT = 'PUT';
    public const DELETE = 'DELETE';

    public const CONTENT_TYPE_JSON = 'application/json';
    public const CONTENT_TYPE_FORM_URLENCODED = 'application/x-www-form-urlencoded';



    /** @var string */
    protected string $endpoint;

    /** @var string */
    protected string $method = self::GET;

    /** @var string  */
    protected string $contentType = self::CONTENT_TYPE_JSON;

    /** @var array */
    protected array $headers = [];

    /** @var ?array */
    protected ?array $data = null;

    /** @var ?array */
    protected ?array $curlInfo = null;



    /**
     * @return void
     */
    public function prepareEndpoint(): void
    {
        if (!empty( $this->data ))
        {
            $this->endpoint .= ( '?' . http_build_query( $this->data ) );

            $this->data = [];
        }
    }


    # ------ Endpoint ------

    /**
     * @return string
     */
    public function getEndpoint(): string
    {
        return $this->endpoint;
    }

    /**
     * @param string $endpoint
     *
     * @return self
     */
    public function setEndpoint( string $endpoint ): self
    {
        $this->endpoint = $endpoint;

        return $this;
    }


    # ----- Method ------

    /**
     * @return string
     */
    public function getMethod(): string
    {
        return $this->method;
    }

    /**
     * @param string $method
     *
     * @return self
     */
    public function setMethod( string $method ): self
    {
        $this->method = $method;

        return $this;
    }


    # ------ Content Type ------

    /**
     * @return string
     */
    public function getContentType(): string
    {
        return $this->contentType;
    }

    /**
     * @param string $contentType
     *
     * @return self
     */
    public function seContentType( string $contentType ): self
    {
        $this->contentType = $contentType;

        return $this;
    }


    # ------ Headers ------

    /**
     * @return array
     */
    public function getHeaders(): array
    {
        return $this->headers;
    }

    /**
     * @param array $headers
     *
     * @return self
     */
    public function setHeaders( array $headers ): self
    {
        $this->headers = $headers;

        return $this;
    }
}