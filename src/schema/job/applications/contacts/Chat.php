<?php

namespace andy87\avito\client\schema\job\applications\contacts;

use andy87\sdk\client\base\components\Schema;

/**
 * Контакты отклика на вакансию
 *
 * @package app\components\api\avito\resources\applies\contacts
 *
 * @documentation https://developers.avito.ru/api-catalog/job/documentation#operation/applicationsGetIds
 *
 * @see AppliesShort::$contacts
 *
 * @property Chat $chat Чат | Example: u2i-2142059193-600277161
 */
class Chat extends Schema
{
    /** @var ?string Идентификатор чата */
    public ?string $value = null;
}