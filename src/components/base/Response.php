<?php declare(strict_types=1);

namespace andy87\avito\client\components\base;

/**
 * Class Response
 *
 * @package src\components\base
 */
abstract class Response extends Resources
{
    /** @var array  */
    protected array $curlInfo = [];



    /**
     * @param array $curlInfo
     *
     * @return void
     */
    public function setCurlInfo( array $curlInfo ): void
    {
        $this->curlInfo = $curlInfo;
    }

    /**
     * @return array
     */
    public function getCurlInfo(): array
    {
        return $this->curlInfo;
    }


    /**
     * @return array
     */
    public function asArray(): array
    {
        return (array) $this;
    }

    /**
     * @param ?string $rules
     *
     * @return bool
     */
    abstract public function validate(?string $rules = null ): bool;
}