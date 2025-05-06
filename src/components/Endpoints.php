<?php declare(strict_types=1);

namespace andy87\avito\client\components;

/**
 * Class Endpoints
 *
 * @package app\components\sdk\sdkAvito
 */
abstract class Endpoints
{
    /** @var string  */
    public const TOKEN = '/token';

    /** @var string  */
    public const APPLICATIONS_WEBHOOK = '/job/v1/applications/webhook';


}