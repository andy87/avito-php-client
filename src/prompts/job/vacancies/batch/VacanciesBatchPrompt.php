<?php

namespace andy87\avito\client\prompts\job\vacancies\batch;

use andy87\avito\client\schema\job\vacancies\batch\VacanciesBatchSchema;
use andy87\sdk\client\helpers\MethodRegistry;
use andy87\sdk\client\base\interfaces\AuthorizationInterface;
use andy87\avito\client\ext\AvitoPrompt;
use andy87\avito\client\ext\auth\AvitoAuthBearer;

/**
 * Просмотр данных вакансий
 *
 * По умолчанию fields и params выводятся все.
 * Если указана только часть полей - остальные поля будут отсутствовать в ответе.
 * Для просмотра данных необходимо быть владельцем вакансии.
 *
 * @documentation https://developers.avito.ru/api-catalog/job/documentation#operation/vacanciesGetByIds
 *
 * @package src/prompts/vacancies/batch
 */
final class VacanciesBatchPrompt extends AvitoPrompt
{
    /** @var bool Статус использования префикса конфига */
    public const USE_PREFIX = false;

    /** @var AuthorizationInterface[] Список классов реализующих авторизацию. */
    public const AUTH = [ AvitoAuthBearer::class ];


    /** @var string Схема запроса, определяющая структуру и правила валидации. */
    protected string $schema = VacanciesBatchSchema::class;


    /** @var string Метод запроса */
    public string $method = Method::POST;

    /** @var string Путь к API */
    public string $path = '/job/v2/vacancies/batch';



    /**
     * @var array|string[] Поля для основного тела ответа
     *
     * Items Enum: "title" "description" "url" "salary" "start_time" "update_time" "is_active"
     */
    public array $fields = [];

    /**
     * @var array|int[] Идентификаторы вакансий на сайте
     *
     * Limit: <= 100 items
     */
    public array $ids;

    /**
     * @var array|string[] Дополнительные поля, которые входят в params (можно указать несколько значений через запятую).
     *
     * По умолчанию отображаются все поля.
     * deprecated значения manufacturing_type, industry_type, programs, warehouse_functionality
     *
     * Items Enum: "business_area" "employment" "schedule" "experience" "address" "coordinates" "change" "where_to_work"
     * "payout_frequency" "age_preferences" "piecework_flag" "paid_period" "salary" "salary_base_range" "salary_base_bonus"
     * "taxes" "is_company_car" "driving_license_category" "driving_experience" "delivery_method" "profession"
     * "registration_method" "grade" "medical_specialization" "education_level" "bonuses" "worker_class"
     * "food_production_shop_type" "eatery_type" "cuisine" "medical_book" "retail_equipment_type" "retail_shop_type"
     * "tools_availability" "construction_work_type" "work_format" "manufacturing_type" "industry_type" "programs"
     * "warehouse_functionality" "vehicle_type" "administrator_organization_type"
     */
    public array $params = [];


    /**
     * Конструктор класса VacanciesBatchPrompt.
     *
     * @param array $ids Идентификаторы вакансий на сайте (до 100).
     * @param array $fields Поля для основного тела ответа.
     * @param array $params Дополнительные поля, которые входят в params.
     */
    public function __construct( array $ids, array $fields = [], array $params = [] )
    {
        $this->ids = $ids;
        $this->fields = $fields;
        $this->params = $params;
    }
}