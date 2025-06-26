<?php

namespace andy87\avito\client\schema\dto;

use andy87\sdk\client\base\components\Schema;

/**
 * DTO для ресурса
 */
class Resource extends Schema
{
    /** @var null|string URL фото */
    public ?string $url = null;
}