<?php declare(strict_types=1);

namespace andy87\avito\client\components\interfaces;

use andy87\avito\client\components\response\TokenResponse;

/**
 * Interface CacheManagerInterface
 *
 * @package src\components\interfaces
 */
interface CacheManagerInterface
{
    public function setCacheAccess( string $key, TokenResponse $tokenResponse, array $options = [] ): void;

    public function getCacheAccess( string $key ): ?TokenResponse;

    public function getCacheKey(): string;
}