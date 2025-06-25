<?php

namespace andy87\avito\client\schema\dto;

use andy87\sdk\client\base\components\Schema;
use andy87\sdk\client\core\transport\Response;

/**
 * Class Result
 */
final class Result extends Schema
{
    public bool $status;

    public string $message;

    public Response $response;
}