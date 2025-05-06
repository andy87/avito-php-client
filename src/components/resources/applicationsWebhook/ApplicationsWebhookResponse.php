<?php declare(strict_types=1);

namespace andy87\avito\client\components\resources\applicationsWebhook;

use andy87\avito\client\components\query\Query;
use andy87\avito\client\components\query\Response;

/**
 * Включение уведомлений по откликам (webhook)
 * Подписка на уведомления о создании и обновлении откликов на вакансии Исключение:
 *
 * изменение сотрудника относящегося к объявлению (employee_id)
 * Важно: проверьте доступность url, при его недоступности из контура Авито webhook не будет создан/перезаписан.
 *
 * @documentation https://developers.avito.ru/api-catalog/job/documentation#operation/applicationsWebhookPut
 */
class ApplicationsWebhookResponse extends Response
{
    /**
     * @var string
     *
     * @criteria GET|PUT
     *
     * @example "cb1e150b-c5bf-4c3e-acd1-20ec88bdb3a1"
     */
    public string $secret;

    /**
     * @var string
     *
     * @criteria GET|PUT
     *
     * @example "https://mysite.webhook/"
     */
    public string $url;

    /**
     * @var bool
     *
     * @criteria DELETE
     *
     * @example true
     */
    public bool $ok;


    /**
     * @param ?string $rules
     *
     * @return bool
     */
    public function isValid( ?string $rules = null ): bool
    {
        return match ($rules) {
            Query::METHOD_DELETE => $this->ok === true,
            default => !empty($this->secret) && !empty($this->url),
        };
    }
}