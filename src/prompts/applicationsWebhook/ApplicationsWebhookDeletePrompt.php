<?php

namespace andy87\avito\client\prompts\applicationsWebhook;

use andy87\sdk\client\helpers\Method;
use andy87\avito\client\schema\applicationsWebhook\ApplicationsWebhookDeleteSchema;

/**
 * Параметры запроса.
 *
 * Отключение уведомлений по откликам (webhook)
 * Отписка от уведомлений о создании и обновлении откликов на вакансии
 *
 * @documentation https://developers.avito.ru/api-catalog/job/documentation#operation/applicationsWebhookDelete
 *
 * @package src/prompt/applicationsWebhook
 */
class ApplicationsWebhookDeletePrompt extends ApplicationsWebhookPrompt
{
    public string $schema = ApplicationsWebhookDeleteSchema::class;

    protected string $method = Method::DELETE;
}
