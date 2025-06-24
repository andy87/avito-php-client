<?php

namespace andy87\avito\client;

use andy87\avito\client\prompts\applications\ApplicationsGetIdsPrompt;
use andy87\avito\client\prompts\resume\ResumeGetContactsPrompt;
use andy87\avito\client\prompts\vacancies\batch\VacanciesBatchPrompt;
use andy87\avito\client\schema\applications\ApplicationsGetIdsSchema;
use andy87\avito\client\schema\resumes\ResumeGetContactsSchema;
use andy87\avito\client\schema\vacancies\batch\VacanciesBatchSchema;
use andy87\sdk\client\base\interfaces\ClientInterface;
use andy87\sdk\client\base\modules\AbstractCache;
use andy87\sdk\client\base\modules\AbstractLogger;
use andy87\sdk\client\base\modules\AbstractTest;
use andy87\sdk\client\base\modules\AbstractTransport;
use Exception;
use andy87\avito\client\ext\AvitoAccount;
use andy87\avito\client\helpers\GrantType;
use andy87\avito\client\prompts\token\AccessTokenPrompt;
use andy87\avito\client\prompts\resume\ResumeGetItemPrompt;
use andy87\avito\client\prompts\applicationsWebhook\ApplicationsWebhookPrompt;
use andy87\avito\client\prompts\applicationsWebhook\ApplicationsWebhookGetPrompt;
use andy87\avito\client\prompts\applicationsWebhook\ApplicationsWebhookPutPrompt;
use andy87\avito\client\prompts\applicationsWebhook\ApplicationsWebhookDeletePrompt;
use andy87\avito\client\schema\token\AccessTokenSchema;
use andy87\avito\client\schema\resumes\ResumeGetItemSchema;
use andy87\avito\client\schema\applicationsWebhook\ApplicationsWebhookSchema;
use andy87\avito\client\schema\applicationsWebhook\ApplicationsWebhookPutSchema;
use andy87\avito\client\schema\applicationsWebhook\ApplicationsWebhookDeleteSchema;

/**
 * AvitoService
 *
 * Предоставляет методы для работы с Avito API.
 *
 * Сервис служит для упрощения взаимодействия с API, убирая необходимость создания экземпляров Prompts и Client вручную.
 */
class AvitoService
{
    protected const CLASS_CONFIG = AvitoConfig::class;
    protected const CLASS_CLIENT = AvitoClient::class;

    private AvitoClient $client;

    /**
     * Конструктор для создания сервиса Avito API.
     *
     * @throws Exception
     */
    public function __construct( AvitoAccount $account )
    {
        $this->setupClient($account);
    }

    /**
     * Создает экземпляр AvitoClient с заданной конфигурацией.
     *
     * @param AvitoAccount $account
     *
     * @return void
     *
     * @throws Exception
     */
    private function setupClient( AvitoAccount $account ): void
    {
        $config = $this->constructConfig($account);

        $this->client = $this->getClient($config);
    }

    /**
     * Создает конфигурацию для Avito API клиента.
     *
     * @param AvitoAccount $avitoAccount
     *
     * @return AvitoConfig
     *
     * @throws Exception
     */
    protected function constructConfig(AvitoAccount $avitoAccount): AvitoConfig
    {
        $configClass = static::CLASS_CONFIG;

        if ( !is_subclass_of( $configClass, AvitoClient::class ) ) {
            throw new Exception( "Класс $configClass должен быть подклассом AvitoConfig" );
        }

        return new $configClass( $avitoAccount );

    }

    /**
     * Инициализирует клиент Avito API с заданной конфигурацией.
     *
     * @param AvitoConfig $config
     *
     * @return AvitoClient
     *
     * @throws Exception
     */
    protected function getClient(AvitoConfig $config): AvitoClient
    {
        $clientClass = static::CLASS_CLIENT;

        if ( !is_subclass_of( $clientClass, AvitoClient::class ) ) {
            throw new Exception( "Класс $clientClass должен быть подклассом AvitoClient" );
        }

        return new $clientClass( $config );
    }

    /**
     * Получает модуль по его имени.
     *
     * @param string $moduleName
     *
     * @return AbstractLogger|AbstractCache|AbstractTest|AbstractTransport
     *
     * @throws Exception
     */
    protected function getModule( string $moduleName ): AbstractLogger|AbstractCache|AbstractTest|AbstractTransport
    {
        return $this->client->getModule( $moduleName );
    }

    /**
     * @param array $data
     *
     * @return bool|null
     *
     * @throws Exception
     */
    public function cacheSet( array $data ): ?bool
    {
        $account = $this->client->config->getAccount();

        return $this->getModule(ClientInterface::CACHE)?->setData( $account, $data );
    }

    /**
     * @return mixed
     *
     * @throws Exception
     */
    public function cacheGet(): mixed
    {
        $account = $this->client->config->getAccount();

        return  $this->getModule(ClientInterface::CACHE)?->getData( $account );
    }

    /**
     * @param string $grantType
     *
     * @return AccessTokenSchema|null
     *
     * @throws Exception
     */
    public function getAccessToken( string $grantType = GrantType::CLIENT_CREDENTIALS ): ?AccessTokenSchema
    {
        /** @var AvitoAccount $account */
        $account = $this->client->config->getAccount();

        $promptToken = new AccessTokenPrompt( $account->clientId, $account->clientSecret, $grantType );

        /** @var AccessTokenSchema|null $response */
        $response = $this->client->getAccessToken( $promptToken );

        return $response;
    }

    /**
     * Получение информации о подписках (webhook)
     * Получение информации по существующим подпискам на создание и обновление откликов
     *
     * @return ApplicationsWebhookSchema|null
     *
     * @throws Exception
     */
    public function applicationsWebhookGet(): ?ApplicationsWebhookSchema
    {
        $applicationsWebhookPrompt = new ApplicationsWebhookGetPrompt();

        /** @var ApplicationsWebhookSchema|null $response */
        $response = $this->client->applicationsWebhookGet( $applicationsWebhookPrompt );

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
     * @return ApplicationsWebhookPutSchema|null
     *
     * @throws Exception
     */
    public function applicationsWebhookPut( string $url, string $secret = ApplicationsWebhookPrompt::DEFAULT_SECRET ): ?ApplicationsWebhookPutSchema
    {
        $applicationsWebhookPutPrompt = new ApplicationsWebhookPutPrompt( $url, $secret );

        /** @var ApplicationsWebhookPutSchema|null $response */
        $response = $this->client->applicationsWebhookPut( $applicationsWebhookPutPrompt );

        return $response;
    }

    /**
     * Отключение уведомлений по откликам (webhook)
     * Отписка от уведомлений о создании и обновлении откликов на вакансии
     *
     * @param string $url
     *
     * @return ApplicationsWebhookDeleteSchema|null
     *
     * @throws Exception
     */
    public function applicationsWebhookDelete( string $url ): ?ApplicationsWebhookDeleteSchema
    {
        $applicationsWebhookDeletePrompt = new ApplicationsWebhookDeletePrompt();
        $applicationsWebhookDeletePrompt->url = $url;

        /** @var ApplicationsWebhookDeleteSchema|null $response */
        $response = $this->client->applicationsWebhookDelete( $applicationsWebhookDeletePrompt );

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

        /** @var ResumeGetItemSchema|null $resumeGetItemSchema */
        $resumeGetItemSchema = $this->client->resumeGetItem( $resumeGetItemPrompt );

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
        $resumeGetContactsSchema = $this->client->resumeGetContacts( $resumeGetContactsPrompt );

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
        $applicationsGetIdsSchema = $this->client->applicationsGetIds( $applicationsGetIdsPrompt );

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
        $vacanciesBatchSchema = $this->client->vacanciesBatch( $vacanciesBatchPrompt );

        return $vacanciesBatchSchema;
    }
}