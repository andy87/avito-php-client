<?php

namespace andy87\avito\client\schema\job\resumes;

use andy87\avito\client\ext\AvitoSchema;
use andy87\avito\client\schema\dto\Result;
use andy87\avito\client\schema\job\resumes\contacts\Contact;

/**
 * Доступ к контактным данным соискателя
 * Для получения контактов пользователя необходимо приобрести пакет просмотров контактных данных в личном кабинете.
 *
 * @documentation https://developers.avito.ru/api-catalog/job/documentation#operation/resumeGetContacts
 *
 * @package src/schema/job/resumes
 */
final class ResumeGetContactsSchema extends AvitoSchema
{
    /** @var array */
    protected const MAPPING = [
        'contacts' => [Contact::class],
        'full_name' => FullName::class,
        'result' => Result::class,
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