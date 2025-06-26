<?php

namespace andy87\avito\client\schema\job\applications;

use andy87\avito\client\ext\AvitoSchema;
use andy87\avito\client\schema\dto\Result;

/**
 * Получение идентификаторов откликов
 * Возвращает лимитированное количество идентификаторов откликов отсортированных по дате создания начиная с самых свежих,
 * для последующего получения по ним расширенной информации через метод получение списка откликов.
 * Максимальный лимит = 100
 *
 * @documentation https://developers.avito.ru/api-catalog/job/documentation#operation/applicationsGetByIds
 *
 * @package src/schema/job/applications
 */
class ApplicationsGetByIdsSchema extends AvitoSchema
{
    public const MAPPING = [
        'applies' => [AppliesFull::class],
        'result' => Result::class,
    ];

    /**
     * @var array|AppliesFull[]
     */
    public array $applies = [];
}