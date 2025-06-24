<?php

namespace andy87\avito\client;

use andy87\sdk\client\helpers\Port;
use andy87\avito\client\ext\AvitoRequest;
use andy87\avito\client\ext\AvitoAccount;
use andy87\sdk\client\base\components\Config;
use andy87\sdk\client\base\interfaces\ClientInterface;

/**
 * Configuration for Avito API client.
 *
 * @property AvitoAccount $account
 */
class AvitoConfig extends Config
{
    public string $port = Port::HTTPS;


    public string $host = 'api.avito.ru';


    public ?string $prefix = '/job/v1';


    /** @var array $classes Контейнер для переназначения используемых классов*/
    public array $classes = [
        ClientInterface::REQUEST => AvitoRequest::class,
    ];
}