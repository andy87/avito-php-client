<?php

namespace andy87\avito\client\schema\job\applications;

/**
 * Отклик
 *
 * @documentation https://developers.avito.ru/api-catalog/job/documentation#operation/applicationsGetIds
 *
 * @package src/schema/job/applications
 */
final class Applies
{
    /** @var null|string Дата создания */
    public ?string $created_at = null;

    /** @var null|string Идентификатор */
    public ?string $id = null;

    /** @var null|string Дата обновления */
    public ?string $updated_at = null;
}