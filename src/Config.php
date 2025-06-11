<?php

namespace andy87\avito\client;


use andy87\avito\client\core\Account;
use andy87\sdk\client\helpers\Port;

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