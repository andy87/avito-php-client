<?php

namespace andy87\avito\client\data;

use andy87\avito\client\components\Endpoints;
use andy87\avito\client\components\Authorization;
use andy87\avito\client\components\data\ParamsEmployee;
use andy87\avito\client\components\response\AppilicationsGetIdsResponse;
use andy87\avito\client\components\response\ApplicationsGetByIdsResponse;

/**
 * Получение идентификаторов откликов
 *
 * Возвращает лимитированное количество идентификаторов откликов отсортированных по дате создания начиная с самых свежих,
 * для последующего получения по ним расширенной информации через метод получение списка откликов.
 *
 * Максимальный лимит = 100
 *
 * @documentation https://developers.avito.ru/api-catalog/job/documentation#operation/applicationsGetIds
 *
 * @package src\components\resources\applicationsGetIds
 */
final class ApplicationsGetByIds extends ParamsEmployee
{

    public const RESPONSE_CLASS = ApplicationsGetByIdsResponse::class;


    public string $endpoint = Endpoints::APPLICATIONS_GET_IDS;


    public ?string $authorization = Authorization::ACCESS_TOKEN;



    /**
     * Возвращать отклики с датой обновления от указанной даты
     *
     * format: <YYYY-MM-DD>
     * Example: 2006-01-02
     *
     * @var string
     */
    public string $updatedAtFrom;

    /**
     *
     * Идентификатор последнего отклика из предыдущего запроса
     *
     * Пример использования параметра:
     *
     * Получение первой страницы откликов, с датой обновления от 12 июня 2022 года:
     *
     * GET /job/v1/applications/get_ids?updatedAtFrom=2022-06-12
     *
     * [
     *  {"id": "62e3e7e542c3d9af3d85205e",<...>},
     *  <...>,
     *  {"id": "623850d1d3819d935dd02702",<...>}
     * ]
     *
     * Получение следующей страницы откликов:
     *
     * GET /job/v1/applications/get_ids?updatedAtFrom=2022-06-12&cursor=623850d1d3819d935dd02702
     *
     * Example: 623850d1d3819d935dd02702
     *
     * @var string
     */
    public string $cursor;

    /**
     *
     * Идентификаторы вакансий. Опциональный фильтр (можно указать одно или несколько значений через запятую)
     *
     * Example: 2241333,1424232
     *
     * @var string
     */
    public string $vacancyIds;

    /**
     * Отклик просмотрен
     *
     * Example: true
     *
     * @var bool
     */
    public bool $is_viewed;
}