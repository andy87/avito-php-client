<?php

namespace andy87\avito\client\base;

/**
 * Класс Account.
 *
 * Содержет данные для аутентификации и авторизации.
 *
 * @package src\base
 */
class Account extends \andy87\sdk\client\base\Account
{
    public function __construct(public string $clientId, public string $clientSecret)
    {

    }
}