<?php

namespace andy87\avito\client\utils;

/**
 * Сообщения об ошибках, связанных с некорректным токеном доступа.
 *
 * При получении ошибок, связанных с токеном доступа, запрашивайте новый токен доступа.
 *
 * @package src/utils
 */
abstract class Invalid
{
    public const MESSAGE_INVALID_ACCESS_TOKEN = 'invalid access token';

    public const MESSAGE_BAD_BEARER_TOKEN = 'Bad bearer token';

    public const MESSAGE_ACCESS_TOKEN_EXPIRED = 'access token expired';
}