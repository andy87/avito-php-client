<?php

namespace andy87\avito\client\prompts\applications;

use andy87\avito\client\ext\auth\AvitoAuthBearer;
use andy87\avito\client\ext\auth\AvitoAuthEmployee;
use andy87\avito\client\ext\AvitoPrompt;

/**
 * Получение идентификаторов откликов
 *
 * Возвращает лимитированное количество идентификаторов откликов отсортированных по дате создания начиная с самых свежих,
 * для последующего получения по ним расширенной информации через метод получение списка откликов.
 * Максимальный лимит = 100
 *
 * @documentation https://developers.avito.ru/api-catalog/job/documentation#operation/applicationsGetIds
 *
 * @package src/prompts/applications
 */
class ApplicationsGetIdsPrompt extends AvitoPrompt
{
    public const AUTH = [ AvitoAuthBearer::class, AvitoAuthEmployee::class ];

    protected string $path = '/applications/get_ids';


    /**
     * Возвращать отклики с датой обновления от указанной даты
     *
     * @var null|string <YYYY-MM-DD>
     *
     * Example: updatedAtFrom=2006-01-02
     */
    public ?string $updatedAtFrom = null;

    /**
     * Идентификатор последнего отклика из предыдущего запроса
     * Пример использования параметра:
     * Получение первой страницы откликов, с датой обновления от 12 июня 2022 года:
     *      GET /job/v1/applications/get_ids?updatedAtFrom=2022-06-12
     * ```
     * [
     *      {"id": "62e3e7e542c3d9af3d85205e",<...>},
     *      <...>,
     *      {"id": "623850d1d3819d935dd02702",<...>}
     * ]
     * ```
     *
     * Получение следующей страницы откликов:
     *      GET /job/v1/applications/get_ids?updatedAtFrom=2022-06-12&cursor=623850d1d3819d935dd02702
     *
     * @var null|string
     *
     * Example: cursor=623850d1d3819d935dd02702
     */
    public ?string $cursor = null;

    /**
     * Идентификаторы вакансий. Опциональный фильтр (можно указать одно или несколько значений через запятую)
     *
     * @var null|string
     *
     * Example: vacancyIds=2241333,1424232
     */
    public ?string $vacancyIds = null;

    /**
     * Отклик просмотрен
     *
     * @var null|string
     *
     * Example: is_viewed=true
     */
    public ?string $is_viewed = null;
}