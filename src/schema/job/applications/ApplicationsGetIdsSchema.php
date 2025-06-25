<?php

namespace andy87\avito\client\schema\job\applications;

use andy87\avito\client\ext\AvitoSchema;
use andy87\avito\client\schema\dto\Result;

/**
 *  Получение идентификаторов откликов
 *
 * Возвращает лимитированное количество идентификаторов откликов отсортированных по дате создания начиная с самых свежих,
 * для последующего получения по ним расширенной информации через метод получение списка откликов.
 *
 * @documentation https://developers.avito.ru/api-catalog/job/documentation#operation/applicationsGetIds
 *
 * @package src/schema/job/applications
 */
final class ApplicationsGetIdsSchema extends AvitoSchema
{
    protected const MAPPING = [
        'applies' => [Applies::class],
        'result' => Result::class,
    ];

    /**
     * лимитированное количество идентификаторов откликов отсортированных по дате создания начиная с самых свежих
     *
     * @var array
     */
    public array $applies = [];

}