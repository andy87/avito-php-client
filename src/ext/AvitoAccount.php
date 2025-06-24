<?php

namespace andy87\avito\client\ext;


use andy87\sdk\client\base\components\Account;

/**
 * Класс Account.
 *
 * Содержет данные для аутентификации и авторизации.
 *
 * @package src\ext
 */
class AvitoAccount extends Account
{
    /**
     * Конструктор класса Account.
     *
     * @param string $clientId Идентификатор клиента.
     * @param string $clientSecret Секрет клиента.
     */
    public function __construct(
        public string $clientId,
        public string $clientSecret
    ) { }
}