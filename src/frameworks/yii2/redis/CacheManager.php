<?php declare(strict_types=1);

namespace andy87\avito\client\frameworks\yii2\redis;

use Yii;
use yii\redis\Connection;
use yii\base\InvalidConfigException;
use andy87\avito\client\components\resources\TokenResponse;
use andy87\avito\client\components\interfaces\CacheManagerInterface;

/**
 * Class RedisAccessCacheManager
 *
 * @package src\frameworks\yii2\redis
 */
class CacheManager implements CacheManagerInterface
{
    /** @var int Время жизни кэша в часах */
    public int $hourCacheLiveTime = 24;

    /** @var string */
    public string $cacheKey = 'avitoTokenResponse';



    /**
     * @param string $key
     *
     * @return ?TokenResponse
     *
     * @throws InvalidConfigException
     */
    public function getCacheAccess( string $key ): ?TokenResponse
    {
        $redis = $this->getRedis();

        $access = $redis->get($key);

        if ($access === false) {
            return null;
        }

        return $this->unpack($access);
    }

    /**
     * @param string $key
     * @param TokenResponse $tokenResponse
     * @param array $options
     *
     * @throws InvalidConfigException
     */
    public function setCacheAccess( string $key, TokenResponse $tokenResponse, array $options = [] ): void
    {
        $redis = $this->getRedis();

        $redis->set( $this->pack( $tokenResponse ), $key, ...$this->constructOptions($options) );
    }

    /**
     * @return Connection
     *
     * @throws InvalidConfigException
     */
    public function getRedis(): Connection
    {
        /** @var Connection $redis */
        $redis = Yii::$app->get('redis');

        return $redis;
    }

    /**
     * @param TokenResponse $tokenResponse
     *
     * @return string
     */
    public function pack( TokenResponse $tokenResponse ): string
    {
        return serialize( $tokenResponse );
    }

    /**
     * @param string $tokenResponse
     *
     * @return TokenResponse
     */
    public function unpack( string $tokenResponse ): TokenResponse
    {
        return unserialize( $tokenResponse );
    }

    /**
     * @param array $options
     *
     * @return array
     */
    private function constructOptions( array $options ): array
    {
        return array_merge( $options, [
            'EX' => ( 60 * 60 * $this->hourCacheLiveTime )
        ]);
    }

    /**
     * @return string
     */
    public function getCacheKey(): string
    {
        return $this->cacheKey;
    }
}