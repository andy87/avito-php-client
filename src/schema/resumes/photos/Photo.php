<?php

namespace andy87\avito\client\schema\resumes\photos;

use app\components\api\avito\response\base\BaseResponse;

/**
 * Фото в резюме
 */
class Photo extends BaseResponse
{
    /** @var ?string URL фото */
    public ?string $url = null;
}