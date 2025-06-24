<?php

namespace andy87\avito\client\prompts\applicationsWebhook;

use andy87\avito\client\ext\AvitoPrompt;
use andy87\avito\client\schema\applicationsWebhook\ApplicationsWebhookSchema;
use andy87\sdk\client\helpers\Method;

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
    protected string $method = Method::DELETE;
}
