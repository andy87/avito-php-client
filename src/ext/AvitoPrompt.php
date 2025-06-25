<?php

namespace andy87\avito\client\ext;

use andy87\avito\client\schema\dto\Warning;
use andy87\sdk\client\base\components\Prompt;
use andy87\sdk\client\core\transport\Response;
use andy87\sdk\client\helpers\{ MethodRegistry, ContentType };

/**
 * Prompt с доработками для Avito.
 *
 * @package src\ext
 */
abstract class AvitoPrompt extends Prompt
{
    /**
     * Метод HTTP запроса (GET, POST, PUT, DELETE и т.д.).
     *
     * @var string $method
     */
    protected string $method = Method::GET;

    /**
     * Тип контента запроса.
     *
     * @var null|string $contentType
     */
    protected ?string $contentType = ContentType::JSON;
}