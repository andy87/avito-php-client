<?php declare(strict_types=1);

namespace andy87\avito\client\components\response;

use andy87\avito\client\components\base\Query;
use andy87\avito\client\components\base\Response;

/**
 * Включение уведомлений по откликам (webhook)
 * Подписка на уведомления о создании и обновлении откликов на вакансии Исключение:
 *
 * изменение сотрудника относящегося к объявлению (employee_id)
 * Важно: проверьте доступность url, при его недоступности из контура Авито webhook не будет создан/перезаписан.
 *
 * @documentation https://developers.avito.ru/api-catalog/job/documentation#operation/applicationsWebhookPut
 *
 * @package src\components\resources\applicationsWebhook
 */
final class ApplicationsWebhookResponse extends Response
{
    /**
     *
     *
     * @criteria GET|PUT
     *
     * @example "cb1e150b-c5bf-4c3e-acd1-20ec88bdb3a1"
     *
     * @var string
     */
    public string $secret;

    /**
     *
     *
     * @criteria GET|PUT
     *
     * @example "https://mysite.webhook/"
     *
     * @var string
     */
    public string $url;

    /**
     *
     *
     * @criteria DELETE
     *
     * @example true
     *
     * @var bool
     */
    public bool $ok;



    /**
     * @param ?string $rules
     *
     * @return bool
     */
    public function validate( ?string $rules = null ): bool
    {
        return match ($rules) {
            Query::DELETE => $this->ok === true,
            default => !empty($this->secret) && !empty($this->url),
        };
    }
}