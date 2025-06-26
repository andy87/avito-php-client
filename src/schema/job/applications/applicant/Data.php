<?php

namespace andy87\avito\client\schema\job\applications\applicant;

use andy87\sdk\client\base\components\Schema;

/**
 * Получение информации об отклике
 *
 * @documentation https://developers.avito.ru/api-catalog/job/documentation#operation/applicationsGetIds
 *
 * @package app\components\api\avito\resources\applies\applicant
 *
 * @see Applicant::$data
 */
class Data extends Schema
{
    public const EDUCATION_HIGHER = 'higher';
    public const EDUCATION_UNFINISHED_HIGHER = 'unfinished-higher';
    public const EDUCATION_SECONDARY = 'secondary';
    public const EDUCATION_SPECIAL_SECONDARY = 'special-secondary';


    public const GENDER_MALE = 'male';
    public const GENDER_FEMALE = 'female';



    /** @var ?string Дата рождения */
    public ?string $birthday = null;

    /** @var ?string Гражданство */
    public ?string $citizenship = null;

    /** @var ?string Уровень образования */
    public ?string $education = null;

    /** @var ?string Пол */
    public ?string $gender = null;

    /** @var ?string ФИО */
    public ?string $name = null;
}