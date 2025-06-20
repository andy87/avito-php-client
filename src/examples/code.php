<?php

namespace example;


use andy87\avito\client\AvitoService;
use andy87\avito\client\Config;
use andy87\avito\client\examples\AvitoYii2Client;


$avitoService = new AvitoService(
    AvitoYii2Client::class,
    Config::class,
    Yii::$app->params['avito.clientId'],
    Yii::$app->params['avito.clientSecret']
);


$avitoService->getAccessToken(
    Yii::$app->params['avito.clientId'],
    Yii::$app->params['avito.clientSecret']
);