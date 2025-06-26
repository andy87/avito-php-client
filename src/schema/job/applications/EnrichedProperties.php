<?php

namespace andy87\avito\client\schema\job\applications;

use andy87\avito\client\schema\dto\Value;
use andy87\sdk\client\base\components\Schema;

/**
 * Данные о кандидате
 *
 * age
 * object Nullable
 * Возраст. Пусто, если соискатель не оставил эти данные.
 *
 * citizenship
 * object Nullable
 * Гражданство. Пусто, если соискатель не оставил эти данные.
 *
 * matching_status
 * string (EnrichedPropertyMatchingStatus)
 * Enum: "no_criteria" "matched" "mismatched"
 * Статус проверки ответа кандидата по критериям вакансии.Возможные значения:
 *
 * "no_criteria" - к ответу не выставлены критерии
 * "matched" - подошел под критерии
 * "mismatched" - не подошел под критерии
 * value
 * string Nullable
 * Код страны в стандартной кодировке ISO 3166-1 alpha-3. Пусто, если соискатель не оставил эти данные.
 *
 * experience
 * object Nullable
 * Опыт по профессии. Пусто, если соискатель не оставил эти данные.
 *
 * matching_status
 * string (EnrichedPropertyMatchingStatus)
 * Enum: "no_criteria" "matched" "mismatched"
 * Статус проверки ответа кандидата по критериям вакансии.Возможные значения:
 *
 * "no_criteria" - к ответу не выставлены критерии
 * "matched" - подошел под критерии
 * "mismatched" - не подошел под критерии
 * value
 * string Nullable
 * Возможные значения:
 *
 * "0" - нет опыта
 * "lt_1" - меньше года
 * "1".."50" - значения от 1 до 50, опыт в количестве лет
 * "no_experience" - нет опыта
 * "has_experience" - есть опыта
 * Пусто, если соискатель не оставил эти данные.
 * full_name
 * object Nullable
 * ФИО. Пусто, если соискатель не оставил эти данные.
 *
 * matching_status
 * string (EnrichedPropertyMatchingStatus)
 * Enum: "no_criteria" "matched" "mismatched"
 * Статус проверки ответа кандидата по критериям вакансии.Возможные значения:
 *
 * "no_criteria" - к ответу не выставлены критерии
 * "matched" - подошел под критерии
 * "mismatched" - не подошел под критерии
 * value
 * string Nullable
 * Строка со свободным вводом кандидата. Пусто, если соискатель не оставил эти данные.
 *
 * gender
 * object Nullable
 * Пол. Пусто, если соискатель не оставил эти данные.
 *
 * matching_status
 * string (EnrichedPropertyMatchingStatus)
 * Enum: "no_criteria" "matched" "mismatched"
 * Статус проверки ответа кандидата по критериям вакансии.Возможные значения:
 *
 * "no_criteria" - к ответу не выставлены критерии
 * "matched" - подошел под критерии
 * "mismatched" - не подошел под критерии
 * value
 * string Nullable
 * Возможные значения:
 *
 * "male" - мужской
 * "female" - женский
 * Пусто, если соискатель не оставил эти данные.
 * phone
 * object Nullable
 * Номер телефона. Пусто, если соискатель не оставил эти данные.
 *
 * matching_status
 * string (EnrichedPropertyMatchingStatus)
 * Enum: "no_criteria" "matched" "mismatched"
 * Статус проверки ответа кандидата по критериям вакансии.Возможные значения:
 *
 * "no_criteria" - к ответу не выставлены критерии
 * "matched" - подошел под критерии
 * "mismatched" - не подошел под критерии
 * value
 * string Nullable
 * Номер телефона в формате +79211234455. Пусто, если соискатель не оставил эти данные.
 */
class EnrichedProperties extends Schema
{
    public const MAPPING = [
        'age' => Value::class,
        'citizenship' => Value::class,
        'experience' => Value::class,
        'full_name' => Value::class,
        'gender' => Value::class,
        'phone' => Value::class,
    ];

    public const EXPERIENCE_NO = '0';
    public const EXPERIENCE_NOT = 'no_experience';
    public const EXPERIENCE_HAS = 'has_experience';
    public const EXPERIENCE_LT_1 = 'lt_1';


    /** @var string GENDER_MALE Пол мужской */
    public const GENDER_MALE = 'male';

    /** @var string GENDER_FEMALE Пол женский */
    public const GENDER_FEMALE = 'female';


    /** @var string $STATUS_IN_PROGRESS Кандидат еще проходит опрос */
    public const STATUS_IN_PROGRESS = 'in_progress';

    /** @var string $STATUS_NOT_COMPLETED Кандидату не удалось пройти опрос до конца (например, истекло время на опрос) */
    public const STATUS_NOT_COMPLETED = 'not_completed';

    /** @var string $STATUS_COMPLETED_NO_CRITERIA Опрос завершен без оценки ответов по критериям вакансии */
    public const STATUS_COMPLETED_NO_CRITERIA = 'completed_no_criteria';

    /** @var string $STATUS_COMPLETED_MATCHED Опрос завершен, кандидат подошел под критерии вакансии */
    public const STATUS_COMPLETED_MATCHED = 'completed_matched';

    /** @var string $STATUS_COMPLETED_MISMATCHED Опрос завершен, кандидат не подошел под критерии вакансии */
    public const STATUS_COMPLETED_MISMATCHED = 'completed_mismatched';




    /** @var Value $age Возраст. Пусто, если соискатель не оставил эти данные */
    public Value $age;

    /** @var Value $citizenship Код страны в стандартной кодировке ISO 3166-1 alpha-3. Пусто, если соискатель не оставил эти данные. */
    public Value $citizenship;

    /** @var Value $experience Опыт по профессии. Пусто, если соискатель не оставил эти данные. */
    public Value $experience;

    /** @var Value $full_name ФИО. Строка со свободным вводом кандидата. Пусто, если соискатель не оставил эти данные. */
    public Value $full_name;

    /** @var Value $gender Пол. Пусто, если соискатель не оставил эти данные. */
    public Value $gender;

    /** @var Value $phone Номер телефона в формате +79211234455. Пусто, если соискатель не оставил эти данные. */
    public Value $phone;

    /**
     * @var string $status Текущий статус опроса
     */
    public string $status;
}