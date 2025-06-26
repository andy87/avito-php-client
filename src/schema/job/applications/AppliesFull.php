<?php

namespace andy87\avito\client\schema\job\applications;


/**
 * Отклик
 *
 * @documentation https://developers.avito.ru/api-catalog/job/documentation#operation/applicationsGetIds
 *
 * @package src/schema/job/applications
 */
final class AppliesFull extends AppliesShort
{
    public const MAPPING = [
        'applicant' => Applicant::class,
        'contacts' => Contacts::class,
        'employee_id' => 'int',
        'enriched_properties' => EnrichedProperties::class,
    ];


    /** @var string отклик через просмотр телефона */
    public const TYPE_BY_PHONE = 'by_phone';

    /** @var string отклик через чат */
    public const TYPE_BY_CHAT = 'by_chat';



    /** @var Applicant Отклик */
    public Applicant $applicant;


    /** @var Contacts Идентификатор сотрудника */
    public Contacts $contacts;


    /** @var int $employee_id Идентификатор сотрудника */
    public int $employee_id;


    /** @var EnrichedProperties $enriched_properties Идентификатор отклика */
    public EnrichedProperties $enriched_properties;


    /** @var bool $is_viewed Отклик просмотрен */
    public bool $is_viewed;


    /** @var int $negotiation_id Идентификатор отклика старого формата */
    public int $negotiation_id;


    /** @var Prevalidation $prevalidation Статус и результат превалидации кандидата */
    public Prevalidation $prevalidation;


    /** @var Price $price Цена целевого действия (копейки) */
    public Price $price;


    /** @var string $type Тип отклика */
    public string $type;


    /** @var int $vacancy_id Идентификатор вакансии на сайте Авито */
    public int $vacancy_id;

}