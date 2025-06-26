<?php

namespace andy87\avito\client\operators;

use andy87\avito\client\schema\dto\Warning;
use Exception;
use andy87\avito\client\prompts\job\resume\ResumeGetItemPrompt;
use andy87\avito\client\prompts\job\resume\ResumeGetContactsPrompt;
use andy87\avito\client\prompts\job\vacancies\batch\VacanciesBatchPrompt;
use andy87\avito\client\prompts\job\applications\ApplicationsGetIdsPrompt;
use andy87\avito\client\prompts\job\applicationsWebhook\ApplicationsWebhookPrompt;
use andy87\avito\client\prompts\job\applicationsWebhook\ApplicationsWebhookPutPrompt;
use andy87\avito\client\prompts\job\applicationsWebhook\ApplicationsWebhookGetPrompt;
use andy87\avito\client\prompts\job\applicationsWebhook\ApplicationsWebhookDeletePrompt;
use andy87\avito\client\schema\job\resumes\ResumeGetItemSchema;
use andy87\avito\client\schema\job\resumes\ResumeGetContactsSchema;
use andy87\avito\client\schema\job\vacancies\batch\VacanciesBatchSchema;
use andy87\avito\client\schema\job\applications\ApplicationsGetIdsSchema;
use andy87\avito\client\schema\job\applicationsWebhook\ApplicationsWebhookGetSchema;
use andy87\avito\client\schema\job\applicationsWebhook\ApplicationsWebhookPutSchema;
use andy87\avito\client\schema\job\applicationsWebhook\ApplicationsWebhookDeleteSchema;

/**
 * Авито.Работа
 *
 * @documentation https://developers.avito.ru/api-catalog/job/documentation#
 *
 * @package sec/services
 */
final class JobOperator extends BaseAvitoOperator
{
    /**
     * Получение информации о подписках (webhook)
     * Получение информации по существующим подпискам на создание и обновление откликов
     *
     * @documentation https://developers.avito.ru/api-catalog/job/documentation#operation/applicationsWebhookGet
     *
     * @return null|ApplicationsWebhookGetSchema|Warning
     *
     * @throws Exception
     */
    public function applicationsWebhookGet(): null|ApplicationsWebhookGetSchema|Warning
    {
        $applicationsWebhookPrompt = new ApplicationsWebhookGetPrompt();

        /** @var null|ApplicationsWebhookGetSchema $response */
        $response = $this->client->send( $applicationsWebhookPrompt );

        return $response;
    }

    /**
     * Включение уведомлений по откликам (webhook)
     * Подписка на уведомления о создании и обновлении откликов на вакансии Исключение:
     *
     * изменение сотрудника относящегося к объявлению (employee_id)
     * Важно: проверьте доступность url, при его недоступности из контура Авито webhook не будет создан/перезаписан.
     *
     * @documentation https://developers.avito.ru/api-catalog/job/documentation#operation/applicationsWebhookPut
     *
     * @param string $url
     * @param string $secret
     *
     * @return null|ApplicationsWebhookPutSchema|Warning
     *
     * @throws Exception
     */
    public function applicationsWebhookPut( string $url, string $secret = ApplicationsWebhookPrompt::DEFAULT_SECRET ): null|ApplicationsWebhookPutSchema|Warning
    {
        $applicationsWebhookPutPrompt = new ApplicationsWebhookPutPrompt( $url, $secret );

        /** @var null|ApplicationsWebhookPutSchema $response */
        $response = $this->client->send( $applicationsWebhookPutPrompt );

        return $response;
    }

    /**
     * Отключение уведомлений по откликам (webhook)
     * Отписка от уведомлений о создании и обновлении откликов на вакансии
     *
     * @documentation https://developers.avito.ru/api-catalog/job/documentation#operation/applicationsWebhookGet
     *
     * @param string $url
     *
     * @return null|ApplicationsWebhookDeleteSchema|Warning
     *
     * @throws Exception
     */
    public function applicationsWebhookDelete( string $url ): null|ApplicationsWebhookDeleteSchema|Warning
    {
        $applicationsWebhookDeletePrompt = new ApplicationsWebhookDeletePrompt();
        $applicationsWebhookDeletePrompt->url = $url;

        /** @var null|ApplicationsWebhookDeleteSchema $response */
        $response = $this->client->send( $applicationsWebhookDeletePrompt );

        return $response;
    }

    /**
     * Просмотр данных резюме
     *
     * По умолчанию fields и params выводятся все.
     * Если указана только часть полей - остальные поля будут отсутствовать в ответе.
     *
     * @documentation https://developers.avito.ru/api-catalog/job/documentation#operation/resumeGetContacts
     *
     * @param int $resume_id
     * @param null|string $fields
     * @param null|string $params
     * @param bool $photos
     *
     * @return null|ResumeGetItemSchema|Warning
     *
     * @throws Exception
     */
    public function resumeGetItem( int $resume_id, ?string $fields = null, ?string $params = null, bool $photos = false ): null|ResumeGetItemSchema|Warning
    {
        $resumeGetItemPrompt = new ResumeGetItemPrompt( $resume_id, $fields, $params, $photos );

        /** @var null|ResumeGetItemSchema $resumeGetItemSchema */
        $resumeGetItemSchema = $this->client->send( $resumeGetItemPrompt );

        return $resumeGetItemSchema;
    }

    /**
     * Получение контактных данных соискателя
     * Для получения контактов пользователя необходимо приобрести пакет просмотров контактных данных в личном кабинете.
     *
     * @documentation https://developers.avito.ru/api-catalog/job/documentation#operation/resumeGetContacts
     *
     * @param int $resume_id Идентификатор резюме
     *
     * @return null|ResumeGetContactsSchema|Warning
     *
     * @throws Exception
     */
    public function resumeGetContacts( int $resume_id ): null|ResumeGetContactsSchema|Warning
    {
        $resumeGetContactsPrompt = new ResumeGetContactsPrompt( $resume_id );

        /** @var null|ResumeGetContactsSchema $resumeGetContactsSchema */
        $resumeGetContactsSchema = $this->client->send( $resumeGetContactsPrompt );

        return $resumeGetContactsSchema;
    }

    /**
     * Получение идентификаторов откликов
     * Возвращает лимитированное количество идентификаторов откликов отсортированных по дате создания начиная с самых свежих,
     * для последующего получения по ним расширенной информации через метод получение списка откликов.
     * Максимальный лимит = 100
     *
     * @documentation https://developers.avito.ru/api-catalog/job/documentation#operation/applicationsGetIds
     *
     * @return null|ApplicationsGetIdsSchema|Warning
     *
     * @throws Exception
     */
    public function applicationsGetIds( ?string $updatedAtFrom = null, ?string $cursor = null, ?string $vacancyIds = null, ?string $is_viewed = null ): null|ApplicationsGetIdsSchema|Warning
    {
        $applicationsGetIdsPrompt = new ApplicationsGetIdsPrompt( $updatedAtFrom, $cursor, $vacancyIds, $is_viewed );

        /** @var null|ApplicationsGetIdsSchema $applicationsGetIdsSchema */
        $applicationsGetIdsSchema = $this->client->send( $applicationsGetIdsPrompt );

        return $applicationsGetIdsSchema;
    }

    /**
     * Просмотр данных вакансий
     *
     * По умолчанию fields и params выводятся все. Если указана только часть полей - остальные поля будут отсутствовать в ответе.
     * Для просмотра данных необходимо быть владельцем вакансии.
     *
     * @documentation https://developers.avito.ru/api-catalog/job/documentation#operation/vacanciesGetByIds
     *
     * Тестовая вакансия: https://www.avito.ru/perm/vakansii/voditel-kurer_ezhednevnye_vyplaty_3605081030
     *
     * @param array $ids Идентификаторы вакансий на сайте
     * @param array $fields Поля для основного тела ответа
     * @param array $params Дополнительные поля, которые входят в params (можно указать несколько значений через запятую).
     *
     * @return null|VacanciesBatchSchema|Warning
     *
     * @throws Exception
     */
    public function vacanciesBatch( array $ids, array $fields = [], array $params = []): null|VacanciesBatchSchema|Warning
    {
        $vacanciesBatchPrompt = new VacanciesBatchPrompt( $ids, $fields, $params );

        /** @var null|VacanciesBatchSchema $vacanciesBatchSchema */
        $vacanciesBatchSchema = $this->client->send( $vacanciesBatchPrompt );

        return $vacanciesBatchSchema;
    }
}