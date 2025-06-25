<?php

namespace andy87\avito\client\ext;

use andy87\avito\client\schema\dto\Result;
use andy87\sdk\client\base\components\Prompt;
use andy87\sdk\client\base\components\Schema;

/**
 * Содержет общие для всех схем свойства
 */
class AvitoSchema extends Schema
{
    protected const MAPPING = [
        'result' => Result::class,
    ];



    public ?Result $result = null;

    public ?string $error = null;
    public ?string $error_description = null;



    /**
     * Проверяет, что схема валидна.
     *
     * @param Prompt $prompt
     *
     * @return bool
     */
    public function validate( Prompt $prompt ): bool
    {
        return ( !$this->error && !$this->error_description );
    }
}