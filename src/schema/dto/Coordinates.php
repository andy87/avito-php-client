<?php

namespace andy87\avito\client\schema\dto;

use andy87\sdk\client\base\components\Schema;

/**
 * Class Coordinates
 *
 * @package src/schema/dto
 */
final class Coordinates extends Schema
{
    /** @var float $latitude Широта */
    public float $latitude;

    /** @var float $longitude Долгота */
    public float $longitude;
}