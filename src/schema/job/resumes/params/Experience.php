<?php

namespace andy87\avito\client\schema\job\resumes\params;

use andy87\avito\client\schema\job\resumes\Params;
use andy87\sdk\client\base\components\Schema;

/**
 * Опыт работы в параметрах резюме
 *
 * @see Params::experience_list
 */
class Experience  extends Schema
{
    /** @var null|string Компания */
    public ?string $company = null;

    /** @var null|string Должность */
    public ?string $position = null;

    /** @var null|string Обязанности */
    public ?string $responsibilities = null;

    /** @var null|string Дата начала работы */
    public ?string $work_start = null;

    /** @var null|string Дата окончания работы */
    public ?string $work_finish = null;
}