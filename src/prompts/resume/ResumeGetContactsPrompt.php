<?php

namespace andy87\avito\client\prompts\resume;

use andy87\avito\client\ext\AvitoPrompt;
use andy87\avito\client\ext\auth\AvitoAuthBearer;
use andy87\sdk\client\base\interfaces\AuthorizationInterface;
use andy87\avito\client\schema\resumes\ResumeGetContactsSchema;

/**
 * Доступ к контактным данным соискателя
 * Для получения контактов пользователя необходимо приобрести пакет просмотров контактных данных в личном кабинете.
 *
 * @documentation https://developers.avito.ru/api-catalog/job/documentation#operation/resumeGetContacts
 *
 * @package src/prompt/resume
 */
class ResumeGetContactsPrompt extends AvitoPrompt
{
    /** @var AuthorizationInterface[] Список классов реализующих авторизацию. */
    public const AUTH = [ AvitoAuthBearer::class ];



    /** @var string Схема запроса, определяющая структуру и правила валидации. */
    public string $schema = ResumeGetContactsSchema::class;

    /** @var string Путь запроса к API. */
    protected string $path = 'resumes/%d/contacts/';


    /**
     * @var int Идентификатор резюме
     *
     * integer <int64>
     */
    protected int $resume_id;



    /**
     * Конструктор класса ResumeGetContactsPrompt.
     *
     * @param int $resume_id Идентификатор резюме
     */
    public function __construct(int $resume_id)
    {
        $this->resume_id = $resume_id;
    }

    /**
     * Возвращает путь запроса.
     *
     * @return string
     */
    public function getPath(): string
    {
        return sprintf( $this->path, $this->resume_id );
    }
}