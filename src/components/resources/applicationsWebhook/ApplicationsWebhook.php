<?php declare(strict_types=1);

namespace andy87\avito\client\components\resources\applicationsWebhook;

use andy87\avito\client\components\Endpoints;
use andy87\avito\client\components\Authorization;
use andy87\avito\client\components\resources\Params;

/**
 * Включение уведомлений по откликам (webhook)
 * Подписка на уведомления о создании и обновлении откликов на вакансии Исключение:
 *
 * изменение сотрудника относящегося к объявлению (employee_id)
 * Важно: проверьте доступность url, при его недоступности из контура Авито webhook не будет создан/перезаписан.
 *
 * @documentation https://developers.avito.ru/api-catalog/job/documentation#operation/applicationsWebhookPut
 */
class ApplicationsWebhook extends Params
{
    public const RESPONSE_CLASS = ApplicationsWebhookResponse::class;

    public string $endpoint = Endpoints::APPLICATIONS_WEBHOOK;

    public ?string $authorization = Authorization::CLIENT_CREDENTIALS;



    /** @var string */
    public string $secret;

    /** @var string */
    public string $url;



    /**
     * @param string $url
     * @param string $secret
     * @param string $method
     */
    public function __construct ( string $url, string $secret = __METHOD__, string $method = self::METHOD_GET )
    {
        $this->url = $url;

        $this->secret = $secret;

        $this->method = $method;
    }
}