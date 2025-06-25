<?php

namespace andy87\avito\client\prompts\auth;

use andy87\sdk\client\helpers\Method;
use andy87\sdk\client\helpers\ContentType;
use andy87\avito\client\ext\AvitoPrompt;
use andy87\avito\client\utils\GrantType;
use andy87\avito\client\schema\auth\AccessTokenSchema;

/**
 * Получение access token
 * Получения временного ключа для авторизации
 *
 * @documentation https://developers.avito.ru/api-catalog/auth/documentation#operation/getAccessToken
 *
 * @package src/prompts/auth/token
 */
class AccessTokenPrompt extends AvitoPrompt
{
    public const DEBUG = true;
    
    protected string $schema = AccessTokenSchema::class;
    protected string $path = 'token';

    protected string $method = Method::POST;
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
    public string $grantType = GrantType::CLIENT_CREDENTIALS;



    /**
     * Конструктор для создания запроса на получение токена доступа.
     *
     * @param string $clientId Avito API Client ID.
     * @param string $clientSecret Avito API Client Secret.
     */
    public function __construct( string $clientId, string $clientSecret )
    {
        $this->clientId = $clientId;

        $this->clientSecret = $clientSecret;
    }
}
