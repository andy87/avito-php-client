<?php

namespace andy87\avito\client\prompts\applicationsWebhook;

use andy87\avito\client\schema\applicationsWebhook\ApplicationsWebhookGetSchema;
use andy87\sdk\client\base\BasePrompt;

/**
 * Параметры запроса.
 */
class ApplicationsWebhookPrompt extends BasePrompt
{
    /** @var string Значение по умолчанию для секретного ключа вебхука. */
    public const DEFAULT_SECRET = 'secret';


    /** @var string $schema JSON Schema для валидации запроса. */
    public string $schema = ApplicationsWebhookGetSchema::class;


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
