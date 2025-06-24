<?php

namespace andy87\avito\client\schema\resumes\photos;

use andy87\sdk\client\base\components\Schema;

/**
 * Фото в резюме
 */
class Photo extends Schema
{
    /** @var null|string URL фото */
    public ?string $url = null;
}