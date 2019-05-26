<?php

namespace BotClient;

use BotClient\Base\BaseClient\BaseTelegramClient;

class TelegramClient extends BaseTelegramClient
{
    public function sendMessage(string $text, string $chat_id, string $username = null)
    {
        if ($username == null)
            $this->sendRequest('sendMessage', ['chat_id' => $chat_id, 'text' => "$text"]);
        else $this->sendRequest('sendMessage', ['chat_id' => $chat_id, 'text' => "@$username, $text"]);
    }

    public function sendMessageToAllUsers(string $text)
    {
        $db = DbConn::getConnection();

        $result = $db->query("SELECT chat_id FROM active_users");

        $i = 0;
        while ($row = $result->fetch()) {
            $this->sendMessage($text, $row['chat_id']);
            sleep(1);
            $i++;
        }

        unset($db);
    }
}