<?php declare(strict_types=1);

namespace andy87\avito\client\components;

/**
 * @documentation https://developers.avito.ru
 *
 * @package src\components
 */
abstract class Authorization
{
    /** @var string `Bearer ACCESS_TOKEN` для авторизации */
    public const ACCESS_TOKEN = 'access_token';
}