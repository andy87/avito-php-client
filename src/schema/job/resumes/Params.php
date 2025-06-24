<?php

namespace andy87\avito\client\schema\job\resumes;

use andy87\avito\client\schema\job\resumes\params\Education;
use andy87\avito\client\schema\job\resumes\params\Experience;
use andy87\avito\client\schema\job\resumes\params\Language;
use andy87\sdk\client\base\components\Schema;


/**
 * Параметры в резюме
 *
 * @package src/schema/job/resumes
 */
class Params extends Schema
{
    /** @var array Мэппинг классов */
    protected const MAPPING = [
        'education_list' => [Education::class],
        'experience_list' => [Experience::class],
        'language_list' => [Language::class],
    ];



    /** @var null|string Готовность к командировкам */
    public ?string $ability_to_business_trip = null;

    /** @var null|string Адрес */
    public ?string $address = null;

    /** @var null|int Возраст */
    public ?int $age = null;

    /** @var null|string Область деятельности */
    public ?string $business_area = null;

    /** @var null|string Образование */
    public ?string $education = null;

    /** @var Education[] Список образований */
    public array $education_list = [];

    /** @var Experience[] Список опыта работы */
    public array $experience_list = [];

    /** @var Language[] Список языков */
    public array $language_list = [];

    /** @var null|string Возможность переезда */
    public ?string $moving = null;

    /** @var null|string Национальность */
    public ?string $nationality = null;

    /** @var null|string Пол */
    public ?string $pol = null;

    /** @var null|string Разрешение на работу в России */
    public ?string $razreshenie_na_rabotu_v_rossii = null;

    /** @var null|string График работы */
    public ?string $schedule = null;
}