<?php

namespace andy87\avito\client\schema\vacancies\batch;

use andy87\sdk\client\base\components\Schema;

class VacanciesBatchSchema extends Schema
{
    public const MAPPING = [
        'items' => [Vacancy::class]
    ];
}