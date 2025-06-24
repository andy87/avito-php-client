<?php

namespace andy87\avito\client\schema\job\resumes\params;

use andy87\avito\client\schema\job\resumes\Params;
use andy87\sdk\client\base\components\Schema;

/**
 * Язык в параметрах резюме
 *
 * @see Params::language_list
 */
class Language extends Schema
{
    /** @var null|string Язык */
    public ?string $language = null;

    /** @var null|string Уровень владения языком */
    public ?string $language_level = null;
}