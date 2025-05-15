<?php declare(strict_types=1);

namespace andy87\avito\client\prompts;

use andy87\avito\client\components\Endpoints;
use andy87\avito\client\components\base\Prompt;
use andy87\avito\client\components\Authorization;
use andy87\avito\client\components\resources\ApplicationsWebhookResponse;

/**
 * Включение уведомлений по откликам (webhook)
 *
 * Подписка на уведомления о создании и обновлении откликов на вакансии Исключение:
 *
 * Изменение сотрудника относящегося к объявлению (employee_id)
 * Важно: проверьте доступность url, при его недоступности из контура Авито webhook не будет создан/перезаписан.
 *
 * @documentation https://developers.avito.ru/api-catalog/job/documentation#operation/applicationsWebhookPut
 *
 * @package src\components\resources\applicationsWebhook
 */
final class ApplicationsWebhook extends Prompt
{
    public const RESPONSE_CLASS = ApplicationsWebhookResponse::class;

    public string $endpoint = Endpoints::APPLICATIONS_WEBHOOK;

    public ?string $authorization = Authorization::ACCESS_TOKEN;



    /** @var string */
    public string $secret;

    /** @var string */
    public string $url;



    /**
     * @param string $url
     * @param string $secret
     * @param string $method
     */
    public function __construct ( string $url, string $secret = __METHOD__, string $method = self::GET )
    {
        $this->url = $url;

        $this->secret = $secret;

        $this->method = $method;
    }
}