<?php

namespace andy87\avito\client\schema\applicationsWebhook;

use andy87\sdk\client\base\Schema;
use andy87\sdk\client\base\interfaces\SchemaInterface;

/**
 * Схема ожидаемого ответа от API.
 */
class ApplicationsWebhookGetSchema extends Schema implements SchemaInterface
{
    /**
     *
     */
    public $value;
}
