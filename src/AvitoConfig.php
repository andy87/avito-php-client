<?php

namespace andy87\avito\client;

use andy87\sdk\client\base\interfaces\ClientInterface;
use andy87\sdk\client\helpers\Port;
use andy87\avito\client\ext\AvitoAccount;
use andy87\sdk\client\base\components\Config;
use andy87\sdk\client\transports\CurlTransportDebug;

/**
 * Configuration for Avito API client.
 *
 * @property AvitoAccount $account
 *
 * @package src
 */
class AvitoConfig extends Config
{
    public string $protocol = Port::HTTPS;

    public string $host = 'api.avito.ru';
}