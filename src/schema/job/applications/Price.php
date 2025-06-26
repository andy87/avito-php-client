<?php

namespace andy87\avito\client\schema\job\applications;

use andy87\sdk\client\base\components\Schema;

/**
 * Цена целевого действия (копейки)
 */
class Price extends Schema
{
    /**
     * @var int Цена целевого действия в бонусах (копейки)
     */
    public int $bonus;

    /**
     * @var int $real Цена целевого действия в реальных деньгах (копейки)
     */
    public int $real;

    /**
     * @var int $total Общая цена целевого действия (копейки)
     */
    public int $total;
}