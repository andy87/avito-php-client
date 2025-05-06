<?php declare(strict_types=1);

namespace andy87\avito\client\components\interfaces;

use andy87\avito\client\components\resources\token\TokenResponse;

/**
 * Interface CacheManagerInterface
 *
 * @package app\components\sdk\sdkAvito\base\interfaces
 */
interface CacheManagerInterface
{
    public function setCacheAccess( string $key, TokenResponse $tokenResponse, array $options = [] ): void;

    public function getCacheAccess( string $key ): ?TokenResponse;

    public function getCacheKey(): string;
}