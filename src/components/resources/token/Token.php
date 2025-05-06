<?php declare(strict_types=1);

namespace andy87\avito\client\components\resources\token;

use andy87\avito\client\components\Endpoints;
use andy87\avito\client\components\resources\Params;

/**
 * @documentation https://developers.avito.ru/api-catalog/auth/documentation#operation/getAccessTokenAuthorizationCode
 *
 * Получение access token
 * Получения временного ключа для авторизации запроса от лица пользователя
 *
 * Request Body schema: application/x-www-form-urlencoded
 */
final class Token extends Params
{
    /** @var string  */
    public const RESPONSE_CLASS = TokenResponse::class;



    /** @var string */
    public string $endpoint = Endpoints::TOKEN;

    /** @var string */
    public string $schema = self::CONTENT_TYPE_FORM_URLENCODED;


    /** @var string */
    public string $client_id;

    /** @var string */
    public string $client_secret;

    /** @var ??string */
    public ?string $code = null;

    /** @var string */
    public string $grant_type;



    /**
     * @param string $client_id
     * @param string $client_secret
     * @param ?string $code
     * @param string $grant_type
     */
    public function __construct( string $client_id, string $client_secret, ?string $code = null, string $grant_type = Authorization::AUTHORIZATION_CODE )
    {
        $this->client_id = $client_id;

        $this->client_secret = $client_secret;

        $this->code = $code;

        $this->grant_type = $grant_type;
    }
}