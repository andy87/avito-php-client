<?php

namespace andy87\avito\client\schema\job\applications;

use andy87\avito\client\schema\job\applications\contacts\Chat;
use andy87\avito\client\schema\job\applications\contacts\Phone;
use andy87\sdk\client\base\components\Schema;

/**
 * Контакты отклика на вакансию
 *
 * @documentation https://developers.avito.ru/api-catalog/job/documentation#operation/applicationsGetByIds
 *
 * @package app\components\api\avito\resources\applies
 *
 * @see AppliesShort::$contacts
 */
class Contacts extends Schema
{
    /** @var array Мэппинг классов */
    protected const CLASS_MAPPING = [
        'chat' => Chat::class,
        'phones' => [Phone::class],
    ];

    /** @var ?Chat Чат */
    public ?Chat $chat = null;

    /** @var array|Phone[] Телефоны */
    public array $phones = [];
}