<?php

namespace andy87\avito\client\schema\job\applicationsWebhook;

use andy87\avito\client\ext\AvitoSchema;

/**
 * Получение информации о подписках (webhook)
 *
 * Получение информации по существующим подпискам на создание и обновление откликов
 *
 * @documentation https://developers.avito.ru/api-catalog/job/documentation#operation/applicationsWebhookGet
 */
abstract class ApplicationsWebhookSchema extends AvitoSchema
{
    public const AUTH = [];

    public string $secret;

    public string $url;
}