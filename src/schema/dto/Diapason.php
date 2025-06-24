<?php

namespace andy87\avito\client\schema\dto;

use andy87\sdk\client\base\components\Schema;

/**
 * Диапазон значений.
 */
class Diapason extends Schema
{
    /** @var int $from Начальное значение диапазона */
    public int $from;

    /** @var int $to Конечное значение диапазона */
    public int $to;
}