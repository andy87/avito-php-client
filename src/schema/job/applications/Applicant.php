<?php

namespace andy87\avito\client\schema\job\applications;

use andy87\sdk\client\base\components\Schema;
use andy87\avito\client\schema\job\applications\applicant\Data;

/**
 * Отклик
 *
 * @documentation https://developers.avito.ru/api-catalog/job/documentation#operation/applicationsGetIds
 *
 * @package app\components\api\avito\resources\applies
 *
 * @see AppliesShort::$applies
 */
class Applicant extends Schema
{
    /** @var array */
    protected const CLASS_MAPPING = [
        'data' => Data::class,
    ];



    /** @var ?Data Данные */
    public ?Data $data = null;

    /** @var ?string Идентификатор | Example: "1110dc2f-be18-47ef-a524-cd1234321d42" */
    public ?string $id = null;

    /** @var ?int Идентификатор резюме | Example: 54312 */
    public ?int $resume_id = null;
}