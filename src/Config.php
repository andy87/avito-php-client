<?php

namespace andy87\avito\client;

use andy87\sdk\client\helpers\Port;
use andy87\avito\client\base\Account;

/**
 * Configuration for Avito API client.
 *
 * @property Account $account
 */
class Config extends \andy87\sdk\client\base\Config
{
    public string $port = Port::HTTPS;

    public string $host = 'api.avito.ru';
}