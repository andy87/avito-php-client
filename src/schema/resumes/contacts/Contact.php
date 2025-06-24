<?php

namespace andy87\avito\client\schema\resumes\contacts;

use app\components\api\avito\response\base\BaseResponse;

/**
 * Контакт

 */
class Contact extends BaseResponse
{
    /** @var ?string Тип контакта */
    public ?string $type = null;

    /** @var ?string Значение контакта */
    public ?string $value = null;
}