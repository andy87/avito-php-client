<?php

namespace andy87\avito\client\schema\job\applications\contacts;

use andy87\sdk\client\base\components\Schema;

/**
 * Телефон отклика на вакансию
 *
 * @documentation https://developers.avito.ru/api-catalog/job/documentation#operation/applicationsGetByIds
 *
 * @package app\components\api\avito\resources\applies\contacts
 */
class Phone extends Schema
{
    /** @var ?string Статус получения контакта от соискателя */
    public ?string $status = null;

    /** @var ?int Номер телефона */
    public ?int $value = null;
}