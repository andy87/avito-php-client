<?php

namespace andy87\avito\client\schema\vacancies\batch;

use andy87\avito\client\schema\dto\Coordinates;
use andy87\sdk\client\base\components\Schema;

/**
 * Параметры вакансии
 *
 * @package src/schema/vacancies/batch
 */
class Params extends Schema
{
    public const MAPPING = [
        'salary' => Salary::class,
        'coordinates' => Coordinates::class,
        'salary_base_range' => SalaryBaseRange::class,
    ];



    public string $address;

    public array $age_preferences = [];

    public array $bonuses = [];

    public string $business_area;

    public array $change = [];

    public array $construction_work_type = [];

    public Coordinates $coordinates;

    public array $cuisine = [];

    public array $delivery_method = [];

    public string $driving_experience;

    public array $driving_license_category = [];

    public array $eatery_type = [];

    public string $experience;

    public array $facility_type = [];

    public array $food_production_shop_type = [];

    public string $is_company_car;

    public string $medical_book;

    public string $paid_period;

    public string $payout_frequency;

    public string $piecework_flag;

    public string $profession;

    public array $programs = [];

    public array $registration_method = [];

    public array $retail_equipment_type = [];

    public array $retail_shop_type = [];

    public Salary $salary;

    public string $salary_base_bonus;

    public SalaryBaseRange $salary_base_range;

    public string $schedule;

    public string $taxes;

    public string $tools_availability;

    public string $where_to_work;

    public array $worker_class = [];
}