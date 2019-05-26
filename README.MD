# telegrambot client 0.0.1
Данный бот умеет:
  - Делать рассылку из записей в MySql
  - Делать рассылку из записей в инфоблоках Bitrix
  - Писать интересные факты
  - Здороваться!

## Важно 
Для использования бота необходимо:
  - Иметь базу данный <название> с таблицами "active_users" и "aero_reminder"
  - Либо базу данных с таблицей "active_users" и инфоблок в Bitrix

## Использование

### Settings.php
Создайте файл settings.php в папке Setup с константами
```php
const TOKEN = 'bot_token';
const HOOK_URL = 'url.ru/hook.php';
```
### db_params.php
В файле db_params указываются настройки подключения к базеданных

```php
return array(
    'host' => '<hostname>',
    'dbname' => '<dbname>',
    'user' => '<username>',
    'password' => '<password>',
);
```

### hook.php
Данный файл отвечает за обработку сообщений от api.telegram
Для регистрации Webhook'a используйте метод registerWebhook() класса TelegramClient
```В конструктор нужно передать константы из файла settings.php```

```php
$client = new TelegramClient(TOKEN, HOOK_URL);
$client->registerWebhook();
```

В данном файле обрабатываюся стандартные сообщения, которые пользователь отправляет боту.
Команды добавляются в конструкцию switch

### TelegtamClient.php
Данный класс имеет 4 метода
  - registerWebhook(); - регистрирует вебхук
  - deleteWebhook(); - удаляет вебхук
  - sendMessage(string $text, string $chat_id, string $username = null); - отправляет сообщение конкретному пользователю
  - sendMessageToAllUsers(string $text) - отправляет сообщение всем зарегистрированным пользователям

Пример использования:

```php 
$client = new TelegramClient(TOKEN, URL);
$client->sendMessage('hello', 321123333);
```
В данном случае бот отправит 'hello' пользователю с указанным chat_id;

```php 
$client = new TelegramClient(TOKEN, URL);
$client->sendMessageToAllUsers('hello');
```

Будет отправлено сообщение 'hello' всем пользователям из таблицы 'active_users'

### MysqlReminder.php
Класс выбирает уникальную запись из таблицы 'aero_reminder'. После этого с помощью ``` sendMessageToAllUsers(string $text) ``` можно отправить сообщение всем пользователям из базы данных

### BitrixReminder.php

Для работы этого скрипта его необходимо подключить в файл с помощью
```php
include('path to BitrixReminder.php');
```
и вызвать функцию 
```php
getUniqueRecordFromBitrix(int $infoBlockId)
```
Она возвращает запись из инфоблока,ID которого передается через параметр функции.





