<?php

namespace andy87\avito\client\schema\resumes;

use andy87\sdk\client\base\components\Schema;
use andy87\avito\client\schema\resumes\contacts\Contact;

/**
 * Контакты
 *
 * @package src/schema/resumes
 */
class Contacts extends Schema
{
    public const ATTR_BOUGHT = 'already_bought';
    public const ATTR_CONTACTS = 'contacts';

    public const ATTR_NAME = 'name';



    /** @var bool Признак того, что контакты уже куплены */
    public bool $already_bought = false;

    /** @var Contact[] Контакты */
    public array $contacts = [];

    /** @var null|string Имя */
    public ?string $name = null;
}