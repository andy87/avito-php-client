<?php

namespace andy87\avito\client\schema\dto;

use andy87\sdk\client\base\components\Schema;

/**
 * Класс Value
 *
 * Представляет собой структуру данных, содержащую статус соответствия и значение.
 */
class Value extends Schema
{
    /** @var string подошел под критерии */
    public const STATUS_MATCHED = 'matched';

    /** @var string не подошел под критерии */
    public const STATUS_MISMATCHED = 'mismatched';

    /** @var string к ответу не выставлены критерии */
    public const STATUS_NO_CRITERIA = 'no_criteria';



    /** @var string $matching_status Статус соответствия */
    public string $matching_status;

    /** @var mixed $value Значение */
    public mixed $value;
}