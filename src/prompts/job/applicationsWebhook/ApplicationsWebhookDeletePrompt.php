<?php

namespace andy87\avito\client\prompts\job\applicationsWebhook;

use andy87\sdk\client\helpers\MethodRegistry;
use andy87\avito\client\schema\job\applicationsWebhook\ApplicationsWebhookDeleteSchema;

/**
 * Параметры запроса.
 *
 * Отключение уведомлений по откликам (webhook)
 * Отписка от уведомлений о создании и обновлении откликов на вакансии
 *
 * @documentation https://developers.avito.ru/api-catalog/job/documentation#operation/applicationsWebhookDelete
 *
 * @package src/prompt/job/applicationsWebhook
 */
final class ApplicationsWebhookDeletePrompt extends ApplicationsWebhookPrompt
{
    public string $schema = ApplicationsWebhookDeleteSchema::class;

    protected string $method = MethodRegistry::DELETE;

    public ?string $contentType = null;

    public string $url;

}
