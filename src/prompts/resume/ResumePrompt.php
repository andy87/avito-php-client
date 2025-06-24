<?php

namespace andy87\avito\client\prompts\resume;

use andy87\avito\client\ext\AvitoPrompt;

/**
 * Просмотр данных резюме
 * По умолчанию fields и params выводятся все. Если указана только часть полей - остальные поля будут отсутствовать в ответе.
 *
 * @documentation https://developers.avito.ru/api-catalog/job/documentation#operation/resumeGetItem
 *
 *
 */
class ResumePrompt extends AvitoPrompt
{
    /**
     * @var string $fields Поля основного тела ответа (можно указать несколько значений через запятую). По умолчанию отображаются все поля.
     * Enum: "title" "description" "url" "salary" "is_purchased" "start_time" "update_time" "is_active"
     * Example: fields=title,description,salary
     */
    public string $fields;

    /**
     * @var string
     */
    public string $params;


    public bool $photos;
}