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

    $avitoService->applicationsWebhookGet();

    $vacancy_id = 3605081030;

    $avitoService->vacancyGet($vacancy_id);

} catch (\Exception $e) {

}