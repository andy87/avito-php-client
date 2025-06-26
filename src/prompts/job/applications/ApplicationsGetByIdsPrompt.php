<?php

namespace andy87\avito\client\prompts\job\applications;

use andy87\avito\client\ext\AvitoPrompt;
use andy87\avito\client\ext\auth\AvitoAuthBearer;
use andy87\avito\client\ext\auth\AvitoAuthEmployee;

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
final class ApplicationsGetByIdsPrompt extends AvitoPrompt
{
    public const AUTH = [ AvitoAuthBearer::class, AvitoAuthEmployee::class ];

    protected string $path = '/job/v1/applications/get_ids';



    /**
     * Возвращать отклики с датой обновления от указанной даты
     *
     * @var null|array|string[]
     */
    public ?array $ids = null;
}