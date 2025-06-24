<?php

namespace andy87\avito\client\schema\applicationsWebhook;

/**
 * Включение уведомлений по откликам (webhook)
 * Подписка на уведомления о создании и обновлении откликов на вакансии Исключение:
 *
 * изменение сотрудника относящегося к объявлению (employee_id)
 * Важно: проверьте доступность url, при его недоступности из контура Авито webhook не будет создан/перезаписан.
 *
 * @documentation https://developers.avito.ru/api-catalog/job/documentation#operation/applicationsWebhookPut
 */
class ApplicationsWebhookPutSchema extends ApplicationsWebhookSchema
{

}