<?php

namespace andy87\avito\client\schema\job\applications;

use andy87\sdk\client\base\components\Schema;

/**
 * Отклик
 *
 * @documentation https://developers.avito.ru/api-catalog/job/documentation#operation/applicationsGetIds
 *
 * @package src/schema/job/applications
 */
class AppliesShort extends Schema
{
    /** @var null|string Дата создания */
    public ?string $created_at = null;

    /** @var null|string Идентификатор */
    public ?string $id = null;

    /** @var null|string Дата обновления */
    public ?string $updated_at = null;
}