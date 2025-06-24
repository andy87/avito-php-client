<?php

namespace andy87\avito\client\schema\vacancies\batch;

use andy87\sdk\client\base\components\Schema;
use andy87\avito\client\schema\dto\AddressDetails;

/**
 *
 */
class Vacancy extends Schema
{
    public const MAPPING = [
        'addressDetails' => AddressDetails::class,
        'params' => Params::class,
    ];



    public AddressDetails $addressDetails;

    public string $description;

    public int $id;

    public bool $is_active;

    public Params $params;

    public int $salary;

    public string $start_time;

    public string $title;

    public string $update_time;

    public string $url;

    public string $uuid;
}