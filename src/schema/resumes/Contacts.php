<?php

namespace andy87\avito\client\schema\resumes;

use app\components\api\avito\response\base\BaseResponse;
use andy87\avito\client\schema\resumes\contacts\Contact;

/**
 * Контакты
 */
class Contacts extends BaseResponse
{
    public const ATTR_BOUGHT = 'already_bought';
    public const ATTR_CONTACTS = 'contacts';

    public const ATTR_NAME = 'name';



    /** @var bool Признак того, что контакты уже куплены */
    public bool $already_bought = false;

    /** @var Contact[] Контакты */
    public array $contacts = [];

    /** @var ?string Имя */
    public ?string $name = null;
}