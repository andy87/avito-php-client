<?php declare(strict_types=1);

namespace andy87\avito\client;

use Exception;
use andy87\avito\client\prompts\Token;
use andy87\avito\client\components\GrandType;
use andy87\avito\client\components\base\Query;
use andy87\avito\client\prompts\ApplicationsWebhook;
use andy87\avito\client\prompts\ApplicationsGetByIds;
use andy87\avito\client\components\clients\ClientLogic;
use andy87\avito\client\components\resources\TokenResponse;
use andy87\avito\client\components\resources\ApplicationsWebhookResponse;
use andy87\avito\client\components\resources\ApplicationsGetByIdsResponse;

/**
 * Class Client
 *
 * Класс с реализацией конкретных методов API
 *
 * Для работы с классом создайте свой класс, который будет наследоваться от него.
 * В классе потомке переопределите свойство `$classOperator`
 *
 * @package src
 */
abstract class Client extends ClientLogic
{
    /**
     * Получение access token
     * Получения временного ключа для авторизации
     *
     * @documentation https://developers.avito.ru/api-catalog/auth/documentation#operation/getAccessToken
     *
     * @param Token $token
     *
     * @return ?TokenResponse
     *
     * @throws Exception
     */
    public function getAccessToken( Token $token ): ?TokenResponse
    {
        $token->grant_type = GrandType::CLIENT_CREDENTIALS;

        /** @var ?TokenResponse $response */
        $response = $this->send( $token );

        return $response;
    }

    /**
     * Получение access token
     * Получения временного ключа для авторизации запроса от лица пользователя
     *
     * @documentation https://developers.avito.ru/api-catalog/auth/documentation#operation/getAccessTokenAuthorizationCode
     *
     * @param Token $token
     *
     * @return ?TokenResponse
     *
     * @throws Exception
     */
    public function getAccessTokenAuthorizationCode( Token $token ): ?TokenResponse
    {
        $token->grant_type = GrandType::AUTHORIZATION_CODE;

        /** @var ?TokenResponse $response */
        $response = $this->send( $token );

        return $response;
    }

    /**
     * Получение access token
     * Получения временного ключа для авторизации запроса от лица пользователя
     *
     * @documentation https://developers.avito.ru/api-catalog/auth/documentation#operation/refreshAccessTokenAuthorizationCode
     *
     * @param Token $token
     *
     * @return ?TokenResponse
     *
     * @throws Exception
     */
    public function refreshAccessTokenAuthorizationCode( Token $token ): ?TokenResponse
    {
        $token->grant_type = GrandType::REFRESH_TOKEN;

        /** @var ?TokenResponse $response */
        $response = $this->send( $token );

        return $response;
    }

    /**
     * Получение информации о подписках (webhook)
     * Получение информации по существующим подпискам на создание и обновление откликов
     *
     * @documentation https://developers.avito.ru/api-catalog/job/documentation#operation/applicationsWebhookGet
     *
     * @param ApplicationsWebhook $webhook
     *
     * @return ?ApplicationsWebhookResponse
     *
     * @throws Exception
     */
    public function applicationsWebhookGet( ApplicationsWebhook $webhook ): ?ApplicationsWebhookResponse
    {
        $webhook = $this->prepareMethod( Query::GET, $webhook );

        /** @var ?ApplicationsWebhookResponse $response */
        $response = $this->send( $webhook );

        return $response;
    }

    /**
     * Включение уведомлений по откликам (webhook)
     * Подписка на уведомления о создании и обновлении откликов на вакансии Исключение:
     *
     * Изменение сотрудника относящегося к объявлению (employee_id)
     * Важно: проверьте доступность url, при его недоступности из контура Авито webhook не будет создан/перезаписан.
     *
     * @documentation https://developers.avito.ru/api-catalog/job/documentation#operation/applicationsWebhookPut
     *
     * @param ApplicationsWebhook $webhook
     *
     * @return ?ApplicationsWebhookResponse
     *
     * @throws Exception
     */
    public function applicationsWebhookPut( ApplicationsWebhook $webhook ): ?ApplicationsWebhookResponse
    {
        $webhook = $this->prepareMethod( Query::PUT, $webhook );

        /** @var ?ApplicationsWebhookResponse $response */
        $response = $this->send( $webhook );

        return $response;
    }

    /**
     * Обновление access token
     * Обновление временного ключа для авторизации запроса от лица пользователя
     *
     * @documentation https://developers.avito.ru/api-catalog/job/documentation#operation/applicationsWebhookDelete
     *
     * @param ApplicationsWebhook $webhook
     *
     * @return ?ApplicationsWebhookResponse
     *
     * @throws Exception
     */
    public function applicationsWebhookDelete( ApplicationsWebhook $webhook ): ?ApplicationsWebhookResponse
    {
        $webhook = $this->prepareMethod( Query::DELETE, $webhook );

        /** @var ?ApplicationsWebhookResponse $response */
        $response = $this->send( $webhook );

        return $response;
    }

    /**
     * Получение списка откликов
     *
     * Получение списка откликов по uuid, полученным по подписке на уведомления (webhook) и через метод получение идентификаторов откликов
     *
     * Максимальный лимит = 100
     *
     * @param ApplicationsGetByIds $applicationsGetByIds
     *
     * @return ?ApplicationsGetByIdsResponse
     *
     * @throws Exception
     */
    public function applicationsGetByIds( ApplicationsGetByIds $applicationsGetByIds )
    {
        /** @var ?ApplicationsGetByIdsResponse $response */
        $response = $this->send( $applicationsGetByIds );

        return $response;
    }

    /**
     * @param string $grantType Тип авторизации
     *
     * @return ?TokenResponse
     *
     * @throws Exception
     */
    public function authorization( string $grantType ): ?TokenResponse
    {
        $tokenResponse = match ($grantType)
        {
            GrandType::CLIENT_CREDENTIALS => $this->getAccessToken( $this->token ),
            GrandType::AUTHORIZATION_CODE => $this->getAccessTokenAuthorizationCode( $this->token ),
            GrandType::REFRESH_TOKEN => $this->refreshAccessTokenAuthorizationCode( $this->token ),
        };

        if ( $tokenResponse->validate() )
        {
            $this->setCache( $tokenResponse );

            return $tokenResponse;
        }

        $this->errorHandler([
            'datetime' => date('Y-m-d H:i:s'),
            '$grantType' => $grantType,
            'token' => $this->token,
            'request' => $tokenResponse
        ]);

        return null;
    }
}