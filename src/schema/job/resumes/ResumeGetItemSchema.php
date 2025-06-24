<?php

namespace andy87\avito\client\schema\job\resumes;

use andy87\sdk\client\base\components\Schema;
use andy87\avito\client\schema\job\resumes\photos\Photo;

/**
 * Данные резюме
 *
 * @documentation https://developers.avito.ru/api-catalog/job/documentation#operation/resumeGetItem
 *
 * @package src/schema/job/resumes
 */
final class ResumeGetItemSchema extends Schema
{
    /** @var array */
    protected const MAPPING = [
        'params' => Params::class,
        'photos' => [Photo::class],
    ];

    /** @var null|string Описание */
    public ?string $description = null;

    /** @var null|int Идентификатор */
    public ?int $id = null;

    /** @var bool Активно */
    public bool $is_active = false;

    /** @var bool Куплено */
    public bool $is_purchased = false;

    /** @var null|Params Данные рещзюме */
    public ?Params $params = null;

    /** @var \andy87\avito\client\schema\job\resumes\photos\Photo[] Фотографии */
    public array $photos = [];

    /** @var null|int Зарплата */
    public ?int $salary = null;

    /** @var null|string Дата начала */
    public ?string $start_time = null;

    /** @var null|string Заголовок */
    public ?string $title = null;

    /** @var null|string Дата обновления */
    public ?string $update_time = null;

    /** @var null|string Ссылка */
    public ?string $url = null;
}