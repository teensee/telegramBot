<?php

namespace BotClient;

use BotClient\Base\BaseClient\BaseTelegramClient;

class TelegramClient extends BaseTelegramClient
{
    //region Webhook
    public function registerWebhook()
    {
        $this->sendRequest('setWebhook', ['url' => $this->link]);
    }

    public function deleteWebhook()
    {
        $this->sendRequest('deleteWebhook', ['url' => $this->link]);
    }
    //endregion

   public function sendMessage(string $text, string $chat_id, string $username = null)
   {
       $this->sendRequest('sendMessage', ['chat_id' => $chat_id, 'text' => "$text"]);
   }


    public function sendMessageToAllUsers()
    {
        $db = DbConn::getConnection();

        $result = $db->query('SELECT chat_id FROM active_users');

        $i = 0;
        while ($row = $result->fetch()) {
            //$this->sendRequest('sendMessage', ['chat_id' => $row['chat_id'], 'text' => "Последний раз,наверное)"]);
            $this->sendMessage('Привет:)', $row['chat_id']);
            sleep(1);
            $i++;
        }

        unset($db);
    }
}