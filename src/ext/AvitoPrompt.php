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
    protected string $method = MethodRegistry::GET;

    /**
     * Тип контента запроса.
     *
     * @var null|string $contentType
     */
    protected ?string $contentType = ContentType::JSON;

    /**
     * @param Response $response
     *
     * @return string
     */
    public function getSchema( Response $response ): string
    {
        if ( $response->getStatusCode() >= 400 ) {
            return Warning::class;
        }

        return parent::getSchema( $response );
    }
}