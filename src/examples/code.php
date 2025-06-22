<?php

namespace example;


use andy87\avito\client\AvitoService;
use andy87\avito\client\AvitoConfig;
use andy87\avito\client\examples\AvitoYii2AvitoBaseClient;


$avitoService = new AvitoService(
    AvitoYii2AvitoBaseClient::class,
    AvitoConfig::class,
    Yii::$app->params['avito.clientId'],
    Yii::$app->params['avito.clientSecret']
);


$avitoService->getAccessToken(
    Yii::$app->params['avito.clientId'],
    Yii::$app->params['avito.clientSecret']
);