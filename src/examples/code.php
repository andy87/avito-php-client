<?php

namespace example;

use andy87\avito\client\AvitoService;
use andy87\avito\client\ext\AvitoAccount;

try
{
    $account = new AvitoAccount(
        \Yii::$app->params['avito.accountId'],
        \Yii::$app->params['avito.accountName']
    );

    $avitoService = new AvitoService($account);

    $avitoService->getOperator()->authService->getAccessToken();
    $avitoService->getOperator()->jobOperator->applicationsWebhookGet();
    $avitoService->getOperator()->jobOperator->applicationsGetIds();
    $avitoService->getOperator()->jobOperator->vacanciesBatch([3605081030]);


    $client = new Avito

} catch (\Exception $e) {

}