<?php

namespace andy87\avito\client\schema\resumes\params;

use app\components\api\avito\response\base\BaseResponse;

/**
 * Опыт работы в параметрах резюме
 *
 * @see Params::experience_list
 */
class Experience extends BaseResponse
{
    /** @var ?string Компания */
    public ?string $company = null;

    /** @var ?string Должность */
    public ?string $position = null;

    /** @var ?string Обязанности */
    public ?string $responsibilities = null;

    /** @var ?string Дата начала работы */
    public ?string $work_start = null;

    /** @var ?string Дата окончания работы */
    public ?string $work_finish = null;
}