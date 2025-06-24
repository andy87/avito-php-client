<?php

namespace andy87\avito\client;

use Exception;
use andy87\avito\client\helpers\GrantType;
use andy87\avito\client\ext\AvitoBaseClient;
use andy87\avito\client\prompts\resume\ResumeGetItemPrompt;
use andy87\avito\client\prompts\token\AccessTokenPrompt;
use andy87\avito\client\prompts\resume\ResumeGetContactsPrompt;
use andy87\avito\client\prompts\vacancies\batch\VacanciesBatchPrompt;
use andy87\avito\client\prompts\applications\ApplicationsGetIdsPrompt;
use andy87\avito\client\prompts\applicationsWebhook\ApplicationsWebhookPrompt;
use andy87\avito\client\prompts\applicationsWebhook\ApplicationsWebhookPutPrompt;
use andy87\avito\client\prompts\applicationsWebhook\ApplicationsWebhookDeletePrompt;
use andy87\avito\client\schema\token\AccessTokenSchema;
use andy87\avito\client\schema\resumes\ResumeGetItemSchema;
use andy87\avito\client\schema\resumes\ResumeGetContactsSchema;
use andy87\avito\client\schema\vacancies\batch\VacanciesBatchSchema;
use andy87\avito\client\schema\applications\ApplicationsGetIdsSchema;
use andy87\avito\client\schema\applicationsWebhook\ApplicationsWebhookSchema;

/**
 * AvitoClient
 */
abstract class AvitoClient extends AvitoBaseClient
{
    /**
     * Обновление access token
     *
     * Обновление временного ключа для авторизации запроса от лица пользователя
     *
     * @documentation https://developers.avito.ru/api-catalog/auth/documentation#operation/refreshAccessTokenAuthorizationCode
     *
     * @return null|AccessTokenSchema
     *
     * @throws Exception
     */
    public function refreshAccessTokenAuthorizationCode(): ?AccessTokenSchema
    {
        $accessTokenPrompt = new AccessTokenPrompt(
            $this->config->account->clientId,
            $this->config->account->clientSecret,
            GrantType::REFRESH_TOKEN
        );

        /** @var null|AccessTokenSchema $accessTokenSchema */
        $accessTokenSchema = $this->send($accessTokenPrompt);

        return $accessTokenSchema;
    }

    /**
     * Получение информации о подписках (webhook)
     * Получение информации по существующим подпискам на создание и обновление откликов
     *
     * @documentation https://developers.avito.ru/api-catalog/job/documentation#operation/applicationsWebhookGet
     *
     * @param ApplicationsWebhookPrompt $applicationsWebhookPrompt
     *
     * @return ?ApplicationsWebhookSchema
     *
     * @throws Exception
     */
    public function applicationsWebhookGet( ApplicationsWebhookPrompt $applicationsWebhookPrompt ): ?ApplicationsWebhookSchema
    {
        /** @var null|ApplicationsWebhookSchema $applicationsWebhookSchema */
        $applicationsWebhookSchema = $this->send( $applicationsWebhookPrompt );

        return $applicationsWebhookSchema;
    }

    /**
     * Отключение уведомлений по откликам (webhook)
     * Отписка от уведомлений о создании и обновлении откликов на вакансии
     *
     * @documentation https://developers.avito.ru/api-catalog/job/documentation#operation/applicationsWebhookDelete
     *
     * @param ApplicationsWebhookDeletePrompt $applicationsWebhookDeletePrompt
     *
     * @return ?ApplicationsWebhookSchema
     *
     * @throws Exception
     */
    public function applicationsWebhookDelete( ApplicationsWebhookDeletePrompt $applicationsWebhookDeletePrompt ): ?ApplicationsWebhookSchema
    {
        /** @var null|ApplicationsWebhookSchema $applicationsWebhookSchema */
        $applicationsWebhookSchema = $this->send( $applicationsWebhookDeletePrompt );

        return $applicationsWebhookSchema;
    }

    /**
     * Включение уведомлений по откликам (webhook)
     * Подписка на уведомления о создании и обновлении откликов на вакансии Исключение:
     * - изменение сотрудника относящегося к объявлению (employee_id)
     *
     * Важно: проверьте доступность url, при его недоступности из контура Авито webhook не будет создан/перезаписан.
     *
     * @documentation https://developers.avito.ru/api-catalog/job/documentation#operation/applicationsWebhookPut
     *
     * @param ApplicationsWebhookPutPrompt $applicationsWebhookPutPrompt
     *
     * @return ?ApplicationsWebhookSchema
     *
     * @throws Exception
     */
    public function applicationsWebhookPut( ApplicationsWebhookPutPrompt $applicationsWebhookPutPrompt ): ?ApplicationsWebhookSchema
    {
        /** @var null|ApplicationsWebhookSchema $applicationsWebhookSchema */
        $applicationsWebhookSchema = $this->send( $applicationsWebhookPutPrompt );

        return $applicationsWebhookSchema;
    }

    /**
     * Просмотр данных резюме
     * По умолчанию fields и params выводятся все. Если указана только часть полей - остальные поля будут отсутствовать в ответе.
     *
     * @documentation https://developers.avito.ru/api-catalog/job/documentation#operation/resumeGetItem
     *
     * @throws Exception
     */
    public function resumeGetItem(ResumeGetItemPrompt $resumePrompt ): ResumeGetItemSchema
    {
        /** @var null|ResumeGetItemSchema $resumeGetItemSchema */
        $resumeGetItemSchema = $this->send( $resumePrompt );

        return $resumeGetItemSchema;
    }

    /**
     * Получение идентификаторов откликов
     * Возвращает лимитированное количество идентификаторов откликов отсортированных по дате создания начиная с самых свежих,
     * для последующего получения по ним расширенной информации через метод получение списка откликов.
     * Максимальный лимит = 100
     *
     * @documentation https://developers.avito.ru/api-catalog/job/documentation#operation/applicationsGetIds
     *
     * @param ApplicationsGetIdsPrompt $applicationsGetIdsPrompt
     *
     * @return ?ApplicationsGetIdsSchema
     *
     * @throws Exception
     */
    public function applicationsGetIds( ApplicationsGetIdsPrompt $applicationsGetIdsPrompt ): ?ApplicationsGetIdsSchema
    {
        /** @var null|ApplicationsGetIdsSchema $applicationsGetIdsSchema */
        $applicationsGetIdsSchema = $this->send( $applicationsGetIdsPrompt );

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
     * @param VacanciesBatchPrompt $vacanciesBatchPrompt
     *
     * @return ?VacanciesBatchSchema
     *
     * @throws Exception
     */
    public function vacanciesBatch( VacanciesBatchPrompt $vacanciesBatchPrompt ): ?VacanciesBatchSchema
    {
        /** @var null|VacanciesBatchSchema $vacancyBatchSchema */
        $vacancyBatchSchema = $this->send( $vacanciesBatchPrompt );

        return $vacancyBatchSchema;
    }


    /**
     * Доступ к контактным данным соискателя
     * Для получения контактов пользователя необходимо приобрести пакет просмотров контактных данных в личном кабинете.
     *
     * @documentation https://developers.avito.ru/api-catalog/job/documentation#operation/resumeGetContacts
     *
     * @param ResumeGetContactsPrompt $resumeGetContactsPrompt
     *
     * @return ?ResumeGetItemSchema
     *
     * @throws Exception
     */
    public function resumeGetContacts( ResumeGetContactsPrompt $resumeGetContactsPrompt ): ?ResumeGetContactsSchema
    {
        /** @var null|ResumeGetContactsSchema $resumeGetContactsSchema */
        $resumeGetContactsSchema = $this->send( $resumeGetContactsPrompt );

        return $resumeGetContactsSchema;
    }
}
