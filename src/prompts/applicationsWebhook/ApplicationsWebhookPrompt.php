<?php

namespace andy87\avito\client\prompts\applicationsWebhook;

use andy87\avito\client\ext\AvitoPrompt;

/**
 * Параметры запроса.
 *
 * Получение информации о подписках (webhook)
 * Получение информации по существующим подпискам на создание и обновление откликов
 *
 * @documentation https://developers.avito.ru/api-catalog/job/documentation#operation/applicationsWebhookGet
 *
 * @package src/prompt/applicationsWebhook
 */
abstract class ApplicationsWebhookPrompt extends AvitoPrompt
{
    /** @var string Значение по умолчанию для секретного ключа вебхука. */
    public const DEFAULT_SECRET = 'secret';

    protected string $path = 'applications/webhook';
}
