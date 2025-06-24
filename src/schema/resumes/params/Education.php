<?php

namespace andy87\avito\client\schema\resumes\params;

use app\components\api\avito\response\base\BaseResponse;

/**
 * Образование в параметрах резюме
 *
 * @see Params::education_list
 */
class Education extends BaseResponse
{
    /** @var ?int Год окончания */
    public ?int $education_stop = null;

    /** @var ?string Учебное заведение */
    public ?string $institution = null;

    /** @var ?string Специальность */
    public ?string $specialty = null;
}