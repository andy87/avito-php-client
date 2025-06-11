<?php


use andy87\avito\client\Config;
use andy87\avito\client\core\Account;
use andy87\avito\client\framework\yii2\AvitoClientYii2;
use andy87\avito\client\prompts\applicationsWebhook\ApplicationsWebhookPrompt;
use andy87\avito\client\prompts\token\AccessTokenPrompt;
use andy87\avito\client\schema\applicationsWebhook\ApplicationsWebhookGetSchema;
use andy87\avito\client\schema\token\AccessTokenSchema;


class AvitoService {
    private $client;

    public function __construct() {

        $config = new Config(new Account(
            Yii::$app->params['avito.clientId'],
            Yii::$app->params['avito.clientSecret']
        ));

        $this->client = new AvitoClientYii2($config);
    }

    /**
     * @param string $clientId
     * @param string $clientSecret
     *
     * @return AccessTokenSchema
     */
    public function getAccessToken(string $clientId, string $clientSecret): AccessTokenSchema
    {
        $promptToken = new AccessTokenPrompt($clientId, $clientSecret);

        return $this->client->getAccessToken($promptToken);
    }

    /**
     * @param string $url
     * @param string $secret
     *
     * @return ?ApplicationsWebhookGetSchema
     */
    public function applicationsWebhookGet( string $url, string $secret = ApplicationsWebhookPrompt::DEFAULT_SECRET ): ?ApplicationsWebhookGetSchema
    {
        $applicationsWebhookPrompt = new ApplicationsWebhookPrompt( $url, $secret );

        return $this->client->applicationsWebhookGet($applicationsWebhookPrompt);
    }
}