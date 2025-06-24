<?php

namespace andy87\avito\client\prompts\job\resume;

use andy87\avito\client\ext\AvitoPrompt;
use andy87\avito\client\ext\auth\AvitoAuthBearer;
use andy87\sdk\client\base\interfaces\AuthorizationInterface;
use andy87\avito\client\schema\job\resumes\ResumeGetItemSchema;

/**
 * Просмотр данных резюме
 * По умолчанию fields и params выводятся все. Если указана только часть полей - остальные поля будут отсутствовать в ответе.
 *
 * @documentation https://developers.avito.ru/api-catalog/job/documentation#operation/resumeGetItem
 */
final class ResumeGetItemPrompt extends AvitoPrompt
{
    /** @var bool Статус использования префикса конфига */
    public const USE_PREFIX = false;

    /** @var AuthorizationInterface[] Список классов реализующих авторизацию. */
    public const AUTH = [ AvitoAuthBearer::class ];


    /** @var string Схема запроса, определяющая структуру и правила валидации. */
    protected string $schema = ResumeGetItemSchema::class;


    /** @var string Путь запроса к API. */
    protected string $path = '/job/v2/resumes/%d';


    /**
     * @var int $resume_id Идентификатор резюме
     *
     * Example: resume_id=123456789
     */
    public int $resume_id;

    /**
     * @var string $fields Поля основного тела ответа (можно указать несколько значений через запятую). По умолчанию отображаются все поля.
     *
     * Enum: "title" "description" "url" "salary" "is_purchased" "start_time" "update_time" "is_active"
     *
     * Example: fields=title,description,salary
     */
    public string $fields = 'title,description,salary';

    /**
     * @var string $params Дополнительные поля, которые входят в params (можно указать несколько значений через запятую). По умолчанию отображаются все поля.
     *
     * Enum: "ability_to_business_trip" "address" "age" "business_area" "education" "education_list" "driver_licence" "driver_licence_category" "experience" "experience_list" "language_list" "moving" "nationality" "pol" "razreshenie_na_rabotu_v_rossii" "schedule"
     *
     * Example: params=address,age
     */
    public string $params = 'ability_to_business_trip,';

    /**
     * @var bool $photos Признак того, нужно ли возвращать картинки
     */
    public bool $photos = false;


    /**
     * Конструктор класса ResumeGetItemPrompt.
     *
     * @param int $resume_id Идентификатор резюме
     * @param null|string $fields Поля основного тела ответа (можно указать несколько значений через запятую). По умолчанию отображаются все поля.
     * @param null|string $params Дополнительные поля, которые входят в params (можно указать несколько значений через запятую). По умолчанию отображаются все поля.
     * @param bool $photos Признак того, нужно ли возвращать картинки
     */
    public function __construct( int $resume_id, ?string $fields = null, ?string $params = null, bool $photos = false )
    {
        $this->resume_id = $resume_id;

        if ($fields) $this->fields = $fields;

        if ($params) $this->params = $params;

        $this->photos = $photos;
    }

    /**
     * {@inheritDoc}
     *
     * @return string
     */
    public function getPath(): string
    {
        return sprintf($this->path, $this->resume_id);
    }
}