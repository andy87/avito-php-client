<?php

namespace andy87\avito\client\schema\resumes;

use andy87\avito\client\schema\resumes\params\Education;
use andy87\avito\client\schema\resumes\params\Experience;
use andy87\avito\client\schema\resumes\params\Language;
use app\components\api\avito\response\base\BaseResponse;


/**
 * Параметры в резюме
 *
 * @see ResumeSchema::params
 */
class Params extends BaseResponse
{
    /** @var array Мэппинг классов */
    protected const CLASS_MAPPING = [
        'education_list' => [Education::class],
        'experience_list' => [Experience::class],
        'language_list' => [Language::class],
    ];



    /** @var ?string Готовность к командировкам */
    public ?string $ability_to_business_trip = null;

    /** @var ?string Адрес */
    public ?string $address = null;

    /** @var ?int Возраст */
    public ?int $age = null;

    /** @var ?string Область деятельности */
    public ?string $business_area = null;

    /** @var ?string Образование */
    public ?string $education = null;

    /** @var Education[] Список образований */
    public array $education_list = [];

    /** @var Experience[] Список опыта работы */
    public array $experience_list = [];

    /** @var Language[] Список языков */
    public array $language_list = [];

    /** @var ?string Возможность переезда */
    public ?string $moving = null;

    /** @var ?string Национальность */
    public ?string $nationality = null;

    /** @var ?string Пол */
    public ?string $pol = null;

    /** @var ?string Разрешение на работу в России */
    public ?string $razreshenie_na_rabotu_v_rossii = null;

    /** @var ?string График работы */
    public ?string $schedule = null;
}