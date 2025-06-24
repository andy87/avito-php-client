<?php

namespace andy87\avito\client;

use andy87\avito\client\helpers\GrantType;
use andy87\avito\client\prompts\token\AccessTokenPrompt;
use andy87\avito\client\schema\token\AccessTokenSchema;
use app\components\api\avito\response\Token;
use Exception;
use andy87\avito\client\ext\AvitoBaseClient;
use andy87\avito\client\schema\resumes\ResumeSchema;
use andy87\avito\client\schema\vacancies\batch\VacancyBatchSchema;
use andy87\avito\client\schema\applications\ApplicationsGetIdsSchema;
use andy87\avito\client\schema\applicationsWebhook\ApplicationsWebhookSchema;
use andy87\avito\client\prompts\resume\ResumePrompt;
use andy87\avito\client\prompts\vacancies\batch\VacanciesBatchPrompt;
use andy87\avito\client\prompts\applications\ApplicationsGetIdsPrompt;
use andy87\avito\client\prompts\applicationsWebhook\ApplicationsWebhookPrompt;
use andy87\avito\client\prompts\applicationsWebhook\ApplicationsWebhookPutPrompt;
use andy87\avito\client\prompts\applicationsWebhook\ApplicationsWebhookDeletePrompt;

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
     * @return AccessTokenSchema
     *
     * @throws Exception
     */
    public function tokenRefresh(): AccessTokenSchema
    {
        $accessTokenPrompt = new AccessTokenPrompt(
            $this->config->account->clientId,
            $this->config->account->clientSecret,
            GrantType::REFRESH_TOKEN
        );

        $params = $this->send($accessTokenPrompt);

        return $this->token($params);
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
        /** @var ApplicationsWebhookSchema|null $schema */
        $schema = $this->send( $applicationsWebhookPrompt );

        return $schema;
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
        /** @var ApplicationsWebhookSchema|null $schema */
        $schema = $this->send( $applicationsWebhookDeletePrompt );

        return $schema;
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
        /** @var ApplicationsWebhookSchema|null $schema */
        $schema = $this->send( $applicationsWebhookPutPrompt );

        return $schema;
    }

    /**
     * Просмотр данных резюме
     * По умолчанию fields и params выводятся все. Если указана только часть полей - остальные поля будут отсутствовать в ответе.
     *
     * @documentation https://developers.avito.ru/api-catalog/job/documentation#operation/resumeGetItem
     *
     * @throws Exception
     */
    public function resumeGetItem( ResumePrompt $resumePrompt ): ResumeSchema
    {
        /** @var ResumeSchema|null $schema */
        $schema = $this->send( $resumePrompt );

        return $schema;
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
        /** @var ApplicationsGetIdsSchema|null $schema */
        $schema = $this->send( $applicationsGetIdsPrompt );

        return $schema;
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
     * @return ?VacancyBatchSchema
     *
     * @throws Exception
     */
    public function vacanciesBatch( VacanciesBatchPrompt $vacanciesBatchPrompt ): ?VacancyBatchSchema
    {

    }
}
