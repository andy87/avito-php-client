<?php

namespace andy87\avito\client\ext;

use andy87\sdk\client\base\components\Prompt;

/**
 * Prompt с доработками для Avito.
 *
 *  USER_X_EMPLOYEE - метка использования заголовка `X-Is-Employee`
 */
abstract class AvitoPrompt extends Prompt
{
    /** @var false Статус включения в заголовки параметра `X-Is-Employee` */
    public const USE_X_EMPLOYEE = false;
}