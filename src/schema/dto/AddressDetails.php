<?php

namespace andy87\avito\client\schema\dto;

use andy87\sdk\client\base\components\Schema;

/**
 * Class AddressDetails
 *
 * @package src/schema/dto
 */
final class AddressDetails extends Schema
{
    public const MAPPING = [
        'coordinates' => Coordinates::class,
    ];

    public string $address;

    public string $city;

    public Coordinates $coordinates;

    public string $province;
}