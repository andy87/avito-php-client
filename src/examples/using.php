<?php

namespace example;

use andy87\avito\client\AvitoClient;
use andy87\avito\client\AvitoConfig;
use andy87\avito\client\AvitoService;
use andy87\avito\client\ext\AvitoAccount;

try
{
    $account = new AvitoAccount(
        \Yii::$app->params['avito.accountId'],
        \Yii::$app->params['avito.accountName']
    );

    $avitoService = new AvitoService($account);

    $avitoService->getOperator()->authOperator->getAccessToken();
    $avitoService->getOperator()->authOperator->getAccessTokenAuthorizationCode('code');
    $avitoService->getOperator()->authOperator->refreshAccessTokenAuthorizationCode('refresh_token');

    $avitoService->getOperator()->jobOperator->applicationsWebhookGet();
    $avitoService->getOperator()->jobOperator->applicationsGetIds();
    $avitoService->getOperator()->jobOperator->vacanciesBatch([3605081030]);



    $config = new AvitoConfig($account);
    $client = new AvitoClient($config);

    $client->operatorManager->authOperator->getAccessToken();
    $client->operatorManager->authOperator->getAccessTokenAuthorizationCode('code');
    $client->operatorManager->authOperator->refreshAccessTokenAuthorizationCode('refresh_token');

    $client->operatorManager->jobOperator->applicationsWebhookGet();
    $client->operatorManager->jobOperator->applicationsGetIds();
    $client->operatorManager->jobOperator->vacanciesBatch([3605081030]);

} catch (\Exception $e) {

}