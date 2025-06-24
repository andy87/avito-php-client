<?php

namespace andy87\avito\client\schema\applications;

use andy87\sdk\client\base\components\Schema;

/**
 *  Получение идентификаторов откликов
 *
 * Возвращает лимитированное количество идентификаторов откликов отсортированных по дате создания начиная с самых свежих,
 * для последующего получения по ним расширенной информации через метод получение списка откликов.
 *
 * @documentation https://developers.avito.ru/api-catalog/job/documentation#operation/applicationsGetIds
 *
 * @package src/schema/applications
 */
class ApplicationsGetIdsSchema extends Schema
{
    protected const MAPPING = [
        'applies' => [Applies::class],
    ];

    /**
     * лимитированное количество идентификаторов откликов отсортированных по дате создания начиная с самых свежих
     *
     * @var array
     */
    public array $applies = [];

}