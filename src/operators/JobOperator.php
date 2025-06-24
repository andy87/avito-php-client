<?php

namespace andy87\avito\client\operators;

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
     * @return null|ApplicationsWebhookGetSchema
     *
     * @throws Exception
     */
    public function applicationsWebhookGet(): ?ApplicationsWebhookGetSchema
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
     * @param string $url
     * @param string $secret
     *
     * @return null|ApplicationsWebhookPutSchema
     *
     * @throws Exception
     */
    public function applicationsWebhookPut( string $url, string $secret = ApplicationsWebhookPrompt::DEFAULT_SECRET ): ?ApplicationsWebhookPutSchema
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
     * @param string $url
     *
     * @return null|ApplicationsWebhookDeleteSchema
     *
     * @throws Exception
     */
    public function applicationsWebhookDelete( string $url ): ?ApplicationsWebhookDeleteSchema
    {
        $applicationsWebhookDeletePrompt = new ApplicationsWebhookDeletePrompt();
        $applicationsWebhookDeletePrompt->url = $url;

        /** @var null|ApplicationsWebhookDeleteSchema $response */
        $response = $this->client->send( $applicationsWebhookDeletePrompt );

        return $response;
    }

    //resumeGetItem

    /**
     * Просмотр данных резюме
     *
     * По умолчанию fields и params выводятся все.
     * Если указана только часть полей - остальные поля будут отсутствовать в ответе.
     *
     * @param int $resume_id
     * @param null|string $fields
     * @param null|string $params
     * @param bool $photos
     *
     * @return null|ResumeGetItemSchema
     *
     * @throws Exception
     */
    public function resumeGetItem( int $resume_id, ?string $fields = null, ?string $params = null, bool $photos = false ): ?ResumeGetItemSchema
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
     * @return null|ResumeGetContactsSchema
     *
     * @throws Exception
     */
    public function resumeGetContacts( int $resume_id ): ?ResumeGetContactsSchema
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
     * @return null|ApplicationsGetIdsSchema
     *
     * @throws Exception
     */
    public function applicationsGetIds(): ?ApplicationsGetIdsSchema
    {
        $applicationsGetIdsPrompt = new ApplicationsGetIdsPrompt();

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
     * @return ?VacanciesBatchSchema
     *
     * @throws Exception
     */
    public function vacanciesBatch( array $ids, array $fields = [], array $params = []): ?VacanciesBatchSchema
    {
        $vacanciesBatchPrompt = new VacanciesBatchPrompt( $ids, $fields, $params );

        /** @var null|VacanciesBatchSchema $vacanciesBatchSchema */
        $vacanciesBatchSchema = $this->client->send( $vacanciesBatchPrompt );

        return $vacanciesBatchSchema;
    }
}