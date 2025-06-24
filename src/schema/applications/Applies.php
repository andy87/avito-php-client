<?php

namespace andy87\avito\client\schema\applications;

/**
 * Отклик
 *
 * @documentation https://developers.avito.ru/api-catalog/job/documentation#operation/applicationsGetIds
 *
 * @package src/schema/applications
 */
class Applies
{
    /** @var ?string Дата создания */
    public ?string $created_at = null;

    /** @var ?string Идентификатор */
    public ?string $id = null;

    /** @var ?string Дата обновления */
    public ?string $updated_at = null;
}