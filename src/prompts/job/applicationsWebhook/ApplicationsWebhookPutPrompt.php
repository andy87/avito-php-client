<?php

namespace andy87\avito\client\prompts\job\applicationsWebhook;

use andy87\avito\client\schema\job\applicationsWebhook\ApplicationsWebhookPutSchema;
use andy87\sdk\client\helpers\ContentType;
use andy87\sdk\client\helpers\MethodRegistry;

/**
 * Параметры запроса.
 *
 * Включение уведомлений по откликам (webhook)
 * Подписка на уведомления о создании и обновлении откликов на вакансии Исключение:
 * - изменение сотрудника относящегося к объявлению (employee_id)
 *
 * Важно: проверьте доступность url, при его недоступности из контура Авито webhook не будет создан/перезаписан.
 *
 * @documentation https://developers.avito.ru/api-catalog/job/documentation#operation/applicationsWebhookPut
 *
 * @package src/prompt/job/applicationsWebhook
 */
final class ApplicationsWebhookPutPrompt extends ApplicationsWebhookPrompt
{
    public string $schema = ApplicationsWebhookPutSchema::class;

    protected string $method = MethodRegistry::PUT;


    /** @var string $url Webhook URL to filter by (optional). */
    public string $url;

    /** @var string $secret Webhook secret key to filter by (optional). */
    public string $secret;

    protected ?string $contentType = ContentType::JSON;



    /**
     * Initialize a new ApplicationsWebhookPrompt.
     *
     * @param string $url Webhook URL to query.
     * @param string $secret Secret key of the webhook (if required).
     */
    public function __construct( string $url, string $secret = self::DEFAULT_SECRET )
    {
        $this->url = $url;

        $this->secret = $secret;
    }
}
