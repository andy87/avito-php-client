<?php

namespace andy87\avito\client\schema\job\vacancies\batch;

use andy87\sdk\client\base\components\Schema;

/**
 * Просмотр данных вакансий
 *
 * По умолчанию fields и params выводятся все.
 * Если указана только часть полей - остальные поля будут отсутствовать в ответе.
 * Для просмотра данных необходимо быть владельцем вакансии.
 *
 * @documentation https://developers.avito.ru/api-catalog/job/documentation#operation/vacanciesGetByIds
 *
 * @package src/schema/job/vacancies/batch
 */
final class VacanciesBatchSchema extends Schema
{
    public const MAPPING = [
        'items' => [Vacancy::class]
    ];
}