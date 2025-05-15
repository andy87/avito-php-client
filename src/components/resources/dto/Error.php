<?php

namespace andy87\avito\client\components\resources\dto;

/**
 * Class Result
 *
 * @package src\components\resources\dto
 */
class Error
{
    // Errors messages
    public const INVALID_ACCESS_TOKEN = 'invalid access token';
    public const BAD_BEARER_TOKEN = 'Bad bearer token';
    public const ACCESS_TOKEN_EXPIRED = 'access token expired';


    public const RECONNECT_MESSAGE = [
        self::INVALID_ACCESS_TOKEN,
        self::BAD_BEARER_TOKEN,
        self::ACCESS_TOKEN_EXPIRED,
    ];


    public const INVALID_CONTENT_TYPE = 'invalid content type';


    public ?int $code = null;

    public ?string $message = null;
}