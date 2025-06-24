<?php

namespace andy87\avito\client\schema\resumes\params;

use app\components\api\avito\response\base\BaseResponse;

/**
 * Язык в параметрах резюме
 *
 * @see Params::language_list
 */
class Language extends BaseResponse
{
    /** @var ?string Язык */
    public ?string $language = null;

    /** @var ?string Уровень владения языком */
    public ?string $language_level = null;
}