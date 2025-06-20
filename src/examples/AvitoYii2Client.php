<?php

namespace andy87\avito\client\examples;

use andy87\avito\client\ext\Client;

/**
 * Class AvitoYii2Client
 *
 * @package src/examples
 */
class AvitoYii2Client extends Client
{
    public function errorHandler(array|string $data): void
    {
        Yii::error(
            'AvitoClient error: ' . print_r($data, true),
            __METHOD__
        );
    }
}