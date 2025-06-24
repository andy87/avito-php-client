<?php

namespace andy87\avito\client\schema\vacancies\batch;

use andy87\sdk\client\base\components\Schema;

class VacancyBatchSchema extends Schema
{
    public const MAPPING = [
        'items' => [Vacancy::class]
    ];
}