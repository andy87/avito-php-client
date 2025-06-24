<?php

namespace andy87\avito\client\prompts\applicationsWebhook;


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
class ApplicationsWebhookGetPrompt extends ApplicationsWebhookPrompt
{
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
    public function __construct( string $url, string $secret = self::DEFAULT_SECRET )
    {
        $this->url = $url;

        $this->secret = $secret;
    }
}
