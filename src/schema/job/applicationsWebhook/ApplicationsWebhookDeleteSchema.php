<?php

namespace andy87\avito\client\schema\job\applicationsWebhook;

use andy87\sdk\client\base\components\Schema;

/**
 * Получение информации о подписках (webhook)
 *
 * Получение информации по существующим подпискам на создание и обновление откликов
 *
 * @documentation https://developers.avito.ru/api-catalog/job/documentation#operation/applicationsWebhookGet
 */
final class ApplicationsWebhookDeleteSchema extends Schema
{
    public bool $ok;
}