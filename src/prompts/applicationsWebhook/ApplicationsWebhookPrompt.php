<?php

namespace andy87\avito\client\prompts\applicationsWebhook;

use andy87\avito\client\ext\AvitoPrompt;
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
class ApplicationsWebhookPrompt extends AvitoPrompt
{
    /** @var string Значение по умолчанию для секретного ключа вебхука. */
    public const DEFAULT_SECRET = 'secret';

    protected string $path = 'applications/webhook';


    /** @var string $schema JSON Schema для валидации запроса. */
    public string $schema = ApplicationsWebhookSchema::class;


    /** @var string $url Webhook URL to filter by (optional). */
    public string $url;

    /** @var string $secret Webhook secret key to filter by (optional). */
    public string $secret;



    /**
     * Initialize a new ApplicationsWebhookPrompt.
     *
     * @param string $url Webhook URL to query.
     * @param string $secret Secret key of the webhook (if required).
     */
    public function __construct( string $url, string $secret )
    {
        $this->url = $url;

        $this->secret = $secret;
    }
}
