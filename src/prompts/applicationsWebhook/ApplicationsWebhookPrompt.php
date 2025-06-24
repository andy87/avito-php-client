<?php

namespace andy87\avito\client\prompts\applicationsWebhook;

use andy87\avito\client\ext\AvitoPrompt;
use andy87\avito\client\ext\auth\AvitoAuthBearer;
use andy87\sdk\client\base\interfaces\AuthorizationInterface;
use andy87\avito\client\schema\applicationsWebhook\ApplicationsWebhookSchema;

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
    /** @var AuthorizationInterface[] Список классов реализующих авторизацию. */
    public const AUTH = [ AvitoAuthBearer::class ];

    /** @var string Значение по умолчанию для секретного ключа вебхука. */
    public const DEFAULT_SECRET = 'secret';


    /** @var string Схема запроса, определяющая структуру и правила валидации. */
    public string $schema = ApplicationsWebhookSchema::class;

    protected string $path = 'applications/webhook';
}
