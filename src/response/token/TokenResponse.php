<?php

namespace andy87\client\avito\response\token;

use BaseClient\BaseResponse;
use BaseClient\ResponseInterface;
use Psr\Http\Message\ResponseInterface as PsrResponseInterface;

/**
 * Response for the access token request.
 * Contains the obtained access token and related info.
 */
class TokenResponse extends BaseResponse implements ResponseInterface
{
    /**
     * OAuth access token string.
     */
    public string $accessToken;

    /**
     * Token expiration time in seconds (if provided).
     */
    public ?int $expiresIn;

    /**
     * Token type (e.g. "Bearer").
     */
    public ?string $tokenType;

    /**
     * Construct a TokenResponse and parse token data.
     * @param PsrResponseInterface $response The raw HTTP response from token request.
     */
    public function __construct(PsrResponseInterface $response)
    {
        parent::__construct($response);
        // Parse the JSON body for token information
        $body = $this->getBody();
        $data = json_decode($body);
        $this->accessToken = isset($data->access_token) ? (string)$data->access_token : '';
        $this->tokenType = isset($data->token_type) ? (string)$data->token_type : 'Bearer';
        $this->expiresIn = isset($data->expires_in) ? (int)$data->expires_in : null;
    }
}
