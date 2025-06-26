# Avito PHP Client

Библиотека для интеграции с API Avito Jobs (и не только), включающая удобные интерфейсы для авторизации, работы с откликами, вакансиями, резюме и webhook'ами.

## Возможности

- Авторизация через логин/пароль, refresh token, employee, bearer
- Работа с откликами и вакансиями
- Получение резюме и контактов кандидатов
- Управление webhook'ами
- Расширяемая архитектура с возможностью переопределения  
  
в процессе наполнения  
  
## Установка

```bash
composer require andy87/avito-php-client
```

## Быстрый старт

```php
use andy87\avito\client\ext\AvitoAccount;
use andy87\avito\client\AvitoConfig;
use andy87\avito\client\AvitoClient;

$client = new AvitoClient(
    new AvitoConfig(
        new AvitoAccount([
            'clientId' => 'ВАШ_ID',
            'clientSecret' => 'ВАШ_СЕКРЕТ',
        ])
    )
);

/** @var AccessTokenSchema $accessTokenSchema */
$accessTokenSchema = $client->operatorManager->authOperator->getAccessToken($login, $password);

/** @var ApplicationsWebhookGetSchema $applicationsWebhookGetSchema */
$applicationsWebhookGetSchema = $client->operatorManager->jobOperator->applicationsWebhookGet();

/** @var ApplicationsWebhookPutSchema $applicationsWebhookPutSchema */
$applicationsWebhookPutSchema = $client->operatorManager->jobOperator->applicationsWebhookPut('url', 'secret')

```

## Cоздание собственного сервиса
Прослойка между клиентом и операторами позволяет уменьшить цепочку вызовов и сделать код более читаемым.

```php

class MyAvitoService extends AvitoService
{
    public function getAccessToken( string $client_id, string $client_secret )
    {
        return $this->client->operatorManager->authOperator->getAccessToken( $client_id, $client_secret);
    }
    
    public function applicationsWebhookGet()
    {
        return $this->client->operatorManager->jobOperator->applicationsWebhookGet();
    }
    
    public function applicationsWebhookPut( string $url, string $secret )
    {
        return $this->client->operatorManager->jobOperator->applicationsWebhookPut($url, $secret);
    }
}
```

Пример использования с собственным сервисом:
```php

$config = new AvitoConfig([
    'clientId' => 'ВАШ_ID',
    'clientSecret' => 'ВАШ_СЕКРЕТ',
]);

$myAvitoService = new MyAvitoService($config);

/** @var AccessTokenSchema $accessTokenSchema */
$accessTokenSchema = $myAvitoService->getAccessToken();

/** @var ApplicationsWebhookGetSchema $applicationsWebhookGetSchema */
$applicationsWebhookGetSchema = $myAvitoService->applicationsWebhookGet();

/** @var ApplicationsWebhookPutSchema $applicationsWebhookPutSchema */
$applicationsWebhookPutSchema = $myAvitoService->applicationsWebhookPut('url', 'secret');

```


## Структура

- `AvitoClient` — основной клиент для вызова API
- `AvitoConfig` — конфигурация авторизации и транспорта
- `prompts/*` — промпты (объекты, описывающие API-запрос)
- `schema/*` — схемы ответов (валидация, структура)
- `operators/*` — операторы (логика вызова  API конкретной группы)
- `ext/*` — расширения и базовые классы клиента
- `utils/*` — вспомогательное

## Примеры

Смотрите в директории `examples/`:
- `using.php` — пример использования клиента
- `responses/` — реальные JSON-ответы API


