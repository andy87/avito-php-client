<?php

namespace andy87\avito\client\schema\resumes\contacts;

use andy87\sdk\client\base\components\Schema;

/**
 * Контакт
 */
class Contact extends Schema
{
    /** @var null|string Тип контакта */
    public ?string $type = null;

    /** @var null|string Значение контакта */
    public ?string $value = null;
}