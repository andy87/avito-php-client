<?php declare(strict_types=1);

namespace andy87\avito\client;

use andy87\avito\client\data\Token;
use andy87\avito\client\components\GrandType;
use andy87\avito\client\components\base\Root;
use andy87\avito\client\components\base\Query;
use andy87\avito\client\components\base\Params;
use andy87\avito\client\data\ApplicationsWebhook;
use andy87\avito\client\components\response\TokenResponse;
use andy87\avito\client\components\response\ApplicationsWebhookResponse;

/**
 * Class SdkAvito
 *
 * @package src
 */
abstract class Client extends Root
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
     */
    public function refreshAccessTokenAuthorizationCode( Token $token ): ?TokenResponse
    {
        $token->grant_type = GrandType::AUTHORIZATION_CODE;

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
     * @documentation https://developers.avito.ru/api-catalog/auth/documentation#operation/refreshAccessTokenAuthorizationCode
     *
     * @param ApplicationsWebhook $webhook
     *
     * @return ?ApplicationsWebhookResponse
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
     */
    public function applicationsGetByIds( ApplicationsGetByIds $applicationsGetByIds )
    {
        /** @var ?ApplicationsGetByIdsResponse $response */
        $response = $this->send( $applicationsGetByIds );

        return $response;
    }



    /**
     * Процесс проверки метода запроса с корректировкой
     *
     * @param string $method
     * @param Params $params
     *
     * @return Params
     */
    private function prepareMethod( string $method, Params $params ): Params
    {
        if ( $params->getMethod() !== $method ) {
            $params->setMethod( $method );
        }

        return $params;
    }
}