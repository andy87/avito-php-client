<?php

namespace andy87\avito\client\framework\yii2;

use andy87\avito\client\AvitoClient;

/**
 * Класс для использования в Yii2
 */
class AvitoClientYii2 extends AvitoClient
{
    public function errorHandler( string|array $data ): bool
    {
        Yii::error([
            'message' => 'Error in AvitoClientYii2',
            'data' => $data,
        ], __METHOD__);
    }
}