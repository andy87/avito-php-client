<?php

namespace andy87\avito\client\schema\job\resumes;

use andy87\sdk\client\base\components\Schema;

/**
 * Полное имя
 *
 * @package src/schema/job/resumes
 */
class FullName extends Schema
{
    /** @var null|string Имя */
    public ?string $first_name = null;


    /** @var null|string Фамилия */
    public ?string $last_name = null;


    /** @var null|string Отчество */
    public ?string $patronymic = null;
}