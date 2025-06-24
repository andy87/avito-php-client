<?php

namespace andy87\avito\client\ext;

use andy87\sdk\client\core\transport\Request;

/**
 * @property AvitoPrompt $prompt
 */
class AvitoRequest extends Request
{
    /**
     * Получение заголовков.
     *
     * Этот метод добавляет в заголовки параметр `X-Is-Employee` если
     * в AvitoPrompt установлена константа со значением `true` ( По умолчанию она: false )
     *
     * @return array
     */
    protected function getHeaders(): array
    {
        $headers = parent::getHeaders();

        if ( $this->prompt::USE_X_EMPLOYEE ) {
            $headers['X-Is-Employee'] = 'true';
        }

        return $headers;
    }
}