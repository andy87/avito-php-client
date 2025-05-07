<?php declare(strict_types=1);

namespace andy87\avito\client\components;

/**
 * Class Endpoints
 *
 * @package src\components
 */
abstract class Endpoints
{
    /** @var string  */
    public const TOKEN = '/token';

    /** @var string  */
    public const APPLICATIONS_WEBHOOK = '/job/v1/applications/webhook';

    /** @var string  */
    public const APPLICATIONS_GET_IDS = '/job/v1/applications/get_ids';
}