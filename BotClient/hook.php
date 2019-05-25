<?php

use BotClient\DataWorker;
use BotClient\TelegramClient;

require_once "../vendor/autoload.php";
include '../Setup/settings.php';
include  '../Setup/joke-selector.php';

$updates = json_decode(file_get_contents('php://input'), JSON_OBJECT_AS_ARRAY);

$client = new TelegramClient(TOKEN, BASE_URL);

$message = $updates['message']['text'];
$chat_id = $updates['message']['chat']['id'];
$user_name = $updates['message']['from']['username'];

try {
    switch ($message) {
        case "/hi":
            $client->sendMessage("Привет, @$user_name!", "$chat_id");
            break;

        case "/help":
            $msg = "На данный момент доступны:\n/hi - приветствие\n/help - помощь\n/joke - случайная шутка!\n/register - добавление в друзья";
            $client->sendMessage($msg, "$chat_id");
            break;

        case "/joke":
            $joker = new JokeSelector();
            $client->sendMessage($joker->getNewJoke(), "$chat_id");
            unset($joker);
            break;
        case "/register":
            DataWorker::addUserToDb($updates) ?
                $client->sendMessage("Добавляю вас в друзья!", "$chat_id")
                : $client->sendMessage("Возможно ты уже зарегистрирован?", "$chat_id");

            break;
        default:
            $client->sendMessage('Извини,я не знаю таких команд :(', "$chat_id");
            break;
    }

} finally {
    unset($client);
}

