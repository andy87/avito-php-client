<?php

namespace andy87\avito\client\schema\dto;

use andy87\avito\client\ext\AvitoSchema;

/**
 * Class Warning
 */
final class Warning extends AvitoSchema
{
    public ?int $code = null;

    public ?bool $status = null;

    public ?string $message = null;
}