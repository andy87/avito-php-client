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
    protected string $schema = AccessTokenSchema::class;
    protected string $path = 'token';

    protected string $method = Method::POST;
    protected ?string $contentType = ContentType::X_WWW_FORM_URLENCODED;



    /**
     * @var string $client_id Avito API Client ID.
     */
    public string $client_id;

    /**
     * @var string $client_secret Avito API Client Secret.
     */
    public string $client_secret;

    /**
     * Тип OAuth flow. Строка refresh_token
     *
     * @var string $grant_type OAuth grant type (e.g. "client_credentials").
     *
     * Default: "refresh_token"
     */
    public string $grant_type = GrantType::CLIENT_CREDENTIALS;



    /**
     * Конструктор для создания запроса на получение токена доступа.
     *
     * @param string $client_id Avito API Client ID.
     * @param string $client_secret Avito API Client Secret.
     */
    public function __construct( string $client_id, string $client_secret )
    {
        $this->client_id = $client_id;

        $this->client_secret = $client_secret;
    }
}
