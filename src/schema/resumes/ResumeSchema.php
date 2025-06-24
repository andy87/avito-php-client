<?php

namespace andy87\avito\client\schema\resumes;

use andy87\sdk\client\base\components\Schema;
use andy87\avito\client\schema\resumes\photos\Photo;

/**
 * Данные резюме
 *
 * @documentation https://developers.avito.ru/api-catalog/job/documentation#operation/resumeGetItem
 */
class ResumeSchema extends Schema
{
    /** @var array */
    protected const CLASS_MAPPING = [
        'params' => Params::class,
        'photos' => [Photo::class],
    ];

    /** @var ?string Описание */
    public ?string $description = null;

    /** @var ?int Идентификатор */
    public ?int $id = null;

    /** @var bool Активно */

    public bool $is_active = false;

    /** @var bool Куплено */
    public bool $is_purchased = false;

    /** @var ?Params Данные рещзюме */
    public ?Params $params = null;

    /** @var Photo[] Фотографии */
    public array $photos = [];

    /** @var ?int Зарплата */
    public ?int $salary = null;

    /** @var ?string Дата начала */
    public ?string $start_time = null;

    /** @var ?string Заголовок */
    public ?string $title = null;

    /** @var ?string Дата обновления */
    public ?string $update_time = null;

    /** @var ?string Ссылка */
    public ?string $url = null;
}