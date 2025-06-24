<?php

namespace andy87\avito\client\schema\resumes;

use andy87\avito\client\schema\resumes\contacts\Contact;
use andy87\sdk\client\base\components\Schema;

/**
 * Доступ к контактным данным соискателя
 * Для получения контактов пользователя необходимо приобрести пакет просмотров контактных данных в личном кабинете.
 *
 * @documentation https://developers.avito.ru/api-catalog/job/documentation#operation/resumeGetContacts
 *
 * @package src/schema/resumes
 */
class ResumeGetContactsSchema extends Schema
{
    /** @var array */
    protected const CLASS_MAPPING = [
        'contacts' => [Contact::class],
        'full_name' => FullName::class,
    ];

    /** @var bool Признак того, что контакты уже куплены */
    public bool $already_bought;

    /** @var Contact[] Контакты */
    public array $contacts = [];

    /** @var FullName Полное имя */
    public FullName $full_name;

    /** @var string Имя */
    public string $name;
}