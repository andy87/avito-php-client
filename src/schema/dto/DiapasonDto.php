<?php

namespace andy87\avito\client\schema\dto;

use andy87\sdk\client\base\components\Schema;

/**
 * Диапазон значений.
 *
 * @property int $from Начальное значение диапазона.
 * @property int $to Конечное значение диапазона.
 */
class DiapasonDto extends Schema
{
    public int $from;
    public int $to;
}