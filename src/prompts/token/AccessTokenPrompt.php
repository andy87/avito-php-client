<?php

namespace andy87\avito\client\prompts\token;

use andy87\avito\client\ext\AvitoPrompt;
use andy87\avito\client\helpers\GrantType;
use andy87\sdk\client\helpers\ContentType;
use andy87\avito\client\schema\token\AccessTokenSchema;

/**
 * Получение access token
 * Получения временного ключа для авторизации
 *
 * @documentation https://developers.avito.ru/api-catalog/auth/documentation#operation/getAccessToken
 *
 * @package src/prompts/token
 */
class AccessTokenPrompt extends AvitoPrompt
{
    protected string $schema = AccessTokenSchema::class;

    protected ?string $contentType = ContentType::X_WWW_FORM_URLENCODED;



    /**
     * @var string $clientId Avito API Client ID.
     */
    public string $clientId;

    /**
     * @var string $clientSecret Avito API Client Secret.
     */
    public string $clientSecret;

    /**
     * Тип OAuth flow. Строка refresh_token
     *
     * @var string $grantType OAuth grant type (e.g. "client_credentials").
     *
     * Default: "refresh_token"
     */
    public string $grantType;



    /**
     * Конструктор для создания запроса на получение токена доступа.
     *
     * @param string $clientId Avito API Client ID.
     * @param string $clientSecret Avito API Client Secret.
     * @param string $grantType OAuth grant type (default "client_credentials").
     */
    public function __construct(string $clientId, string $clientSecret, string $grantType = GrantType::CLIENT_CREDENTIALS )
    {
        $this->clientId = $clientId;

        $this->clientSecret = $clientSecret;

        $this->grantType = $grantType;
    }
}
