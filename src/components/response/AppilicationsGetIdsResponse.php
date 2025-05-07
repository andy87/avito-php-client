<?php

namespace andy87\avito\client\components\response;

use andy87\avito\client\components\base\Response;
use andy87\avito\client\components\response\dto\Applies;

/**
 * Class AppilicationsGetIdsResponse
 *
 * @documentation https://developers.avito.ru/api-catalog/job/documentation#operation/applicationsGetIds
 *
 * @package src\components\response
 */
class AppilicationsGetIdsResponse extends Response
{
    /** @var ?Applies[] */
    public ?array $applies = null;



    /**
     * @param ?string $rules
     *
     * @return bool
     */
    public function validate(?string $rules = null): bool
    {
        return $this->applies !== null;
    }
}