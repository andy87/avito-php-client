<?php

namespace andy87\avito\client\operators;

/**
 * Иерархия Аккаунтов
 *
 * @documentation https://developers.avito.ru/api-catalog/accounts-hierarchy/documentation
 *
 * @package src/operators
 */
final class AccountsHierarchyOperator extends BaseAvitoOperator
{
    /**
     * Получение информации о статусе пользователя в ИА
     * Ручка для получения информации по ИА для пользователя
     *
     * @documentation https://developers.avito.ru/api-catalog/accounts-hierarchy/documentation#operation/checkAhUserV1
     */
    public function checkAhUserV1()
    {
        // Coming soon
    }

    /**
     * Получение списка сотрудников иерархии
     * Для взаимодействия с иерархией аккаунтов необходимо приобрести тариф в личном кабинете.
     *
     * @documentation https://developers.avito.ru/api-catalog/accounts-hierarchy/documentation#operation/linkItemsV1
     */
    public function getEmployeesV1()
    {
        // Coming soon
    }

    /**
     * Прикрепление сотрудника иерархии к объявлениям, перезакрепление объявлений между сотрудниками иерархии
     * Для взаимодействия с иерархией аккаунтов необходимо приобрести тариф в личном кабинете.
     *
     * @documentation https://developers.avito.ru/api-catalog/accounts-hierarchy/documentation#operation/linkItemsV1
     */
    public function linkItemsV1()
    {
        // Coming soon
    }

    /**
     * Получение списка телефонов компании
     * Для взаимодействия с иерархией аккаунтов необходимо приобрести тариф в личном кабинете.
     *
     * @documentation https://developers.avito.ru/api-catalog/accounts-hierarchy/documentation#operation/listCompanyPhonesV1
     */
    public function listCompanyPhonesV1()
    {
        // Coming soon
    }

    /**
     * Получение списка объявлений по сотруднику
     * Ручка для получения списка объявлений по сотруднику с фильтром по категории объявлений. Получение объявлений по компании недоступно.
     *
     * @documentation https://developers.avito.ru/api-catalog/accounts-hierarchy/documentation#ApiUpdatesBlock
     */
    public function ApiUpdatesBlock()
    {
        // Coming soon
    }
}