<?php

namespace andy87\avito\client\schema\job\resumes\params;


use andy87\avito\client\schema\job\resumes\Params;
use andy87\sdk\client\base\components\Schema;

/**
 * Образование в параметрах резюме
 *
 * @see Params::education_list
 */
class Education extends Schema
{
    /** @var null|int Год окончания */
    public ?int $education_stop = null;

    /** @var null|string Учебное заведение */
    public ?string $institution = null;

    /** @var null|string Специальность */
    public ?string $specialty = null;
}