<?php

namespace andy87\avito\client;

use andy87\sdk\client\helpers\Protocol;
use andy87\avito\client\ext\AvitoAccount;
use andy87\sdk\client\base\components\Config;

/**
 * Configuration for Avito API client.
 *
 * @property AvitoAccount $account
 *
 * @package src
 */
class AvitoConfig extends Config
{
    public string $protocol = Protocol::HTTPS;

    public string $host = 'api.avito.ru';
}