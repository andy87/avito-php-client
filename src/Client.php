<?php declare(strict_types=1);

namespace andy87\avito\client;


use andy87\avito\client\components\query\Query;
use andy87\avito\client\components\resources\applicationsWebhook\ApplicationsWebhook;
use andy87\avito\client\components\resources\applicationsWebhook\ApplicationsWebhookResponse;
use andy87\avito\client\components\resources\Params;
use andy87\avito\client\components\resources\token\Token;
use andy87\avito\client\components\resources\token\TokenResponse;
use andy87\avito\client\components\SdkRoot;

/**
 * Class SdkAvito
 *
 * @package app\components\sdk\sdkAvito
 */
abstract class Client extends SdkRoot
{
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
        $token->prepareEndpoint();

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
        $webhook = $this->prepareMethod( Query::METHOD_GET, $webhook );

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
        $webhook = $this->prepareMethod( Query::METHOD_PUT, $webhook );

        /** @var ?ApplicationsWebhookResponse $response */
        $response = $this->send( $webhook );

        return $response;
    }

    /**
     * Отключение уведомлений по откликам (webhook)
     * Отписка от уведомлений о создании и обновлении откликов на вакансии
     *
     * @documentation https://developers.avito.ru/api-catalog/job/documentation#operation/applicationsWebhookDelete
     *
     * @param ApplicationsWebhook $webhook
     *
     * @return ?ApplicationsWebhookResponse
     */
    public function applicationsWebhookDelete( ApplicationsWebhook $webhook ): ?ApplicationsWebhookResponse
    {
        $webhook = $this->prepareMethod( Query::METHOD_DELETE, $webhook );

        /** @var ?ApplicationsWebhookResponse $response */
        $response = $this->send( $webhook );

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