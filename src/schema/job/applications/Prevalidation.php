<?php

namespace andy87\avito\client\schema\job\applications;

use andy87\sdk\client\base\components\Schema;
use andy87\avito\client\schema\job\applications\prevalidation\Summary;

/**
 * Предварительная проверка
 */
class Prevalidation extends Schema
{
    public const MAPPING = [
        'summary' => [Summary::class],
    ];



    /** @var ?string Cтатус */
    public ?string $status = null;

    /** @var ?array|Summary[] Сводка */
    public ?array $summary = null;
}