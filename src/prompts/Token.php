<?php declare(strict_types=1);

namespace andy87\avito\client\prompts;

use andy87\avito\client\components\Endpoints;
use andy87\avito\client\components\GrandType;
use andy87\avito\client\components\base\Prompt;
use andy87\avito\client\components\resources\TokenResponse;

/**
 * Получение access token
 *
 * Получения временного ключа для авторизации запроса от лица пользователя
 *
 * @documentation https://developers.avito.ru/api-catalog/auth/documentation#operation/getAccessTokenAuthorizationCode
 *
 * @package src\components\resources\token
 */
final class Token extends Prompt
{
    /** @var string  */
    public const RESPONSE_CLASS = TokenResponse::class;



    /** @var string */
    public string $endpoint = Endpoints::TOKEN;


    /** @var string */
    public string $client_id;

    /** @var string */
    public string $client_secret;

    /** @var string */
    public string $grant_type;

    /** @var ?string */
    public ?string $code = null;



    /**
     * @param string $client_id
     * @param string $client_secret
     * @param string $grant_type
     * @param ?string $code
     */
    public function __construct( string $client_id, string $client_secret, string $grant_type = GrandType::CLIENT_CREDENTIALS, ?string $code = null )
    {
        $this->client_id = $client_id;

        $this->client_secret = $client_secret;

        $this->code = $code;

        $this->grant_type = $grant_type;
    }
}