<?php declare(strict_types=1);

namespace andy87\avito\client\components\base;

use andy87\avito\client\components\interfaces\RequestInterface;

/**
 * Class Request
 *
 * @package src\components\base
 */
abstract class Request extends Query implements RequestInterface
{
    /** @var Prompt Данные запроса */
    public Prompt $prompt;


    /** @var int Код ответа  */
    protected int $httpCode = 200;


    /** @var ?string Текст ответа  */
    protected ?string $content = null;


    /** @var array Каст текста ответа, приведение к массиву */
    protected array $response = [];


    /** @var ?string Информация об ошибках */
    protected ?string $errors = null;
}