<?php

namespace andy87\avito\client\prompts\token;

use andy87\avito\client\helpers\GrantType;
use andy87\sdk\client\base\components\Prompt;
use andy87\avito\client\schema\token\AccessTokenSchema;

/**
 * Параметры запроса.
 */
class AccessTokenPrompt extends Prompt
{
    public string $schema = AccessTokenSchema::class;


    /**
     * Avito API Client ID.
     */
    public string $clientId;

    /**
     * Avito API Client Secret.
     */
    public string $clientSecret;

    /** OAuth grant type (e.g. "client_credentials"). */
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
