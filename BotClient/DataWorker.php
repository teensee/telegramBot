<?php


namespace BotClient;

use PDO;

class DataWorker
{
    public static function addUserToDb($data)
    {
        $db = DbConn::getConnection();

        $sql = "INSERT INTO active_users(first_name, username, language_code, chat_id, chat_first_name, chat_username, user_id)
            VALUES(:first_name, :username, :language_code, :chat_id, :chat_first_name, :chat_username, :user_id)";

        $result = $db->prepare($sql);

        $result->bindParam(':first_name', $data['message']['from']['first_name'], PDO::PARAM_STR);
        $result->bindParam(':username', $data['message']['from']['username'], PDO::PARAM_STR);
        $result->bindParam(':language_code', $data['message']['from']['language_code'], PDO::PARAM_STR);
        $result->bindParam(':chat_id', $data['message']['chat']['id'], PDO::PARAM_STR);
        $result->bindParam(':chat_first_name', $data['message']['chat']['first_name'], PDO::PARAM_STR);
        $result->bindParam(':chat_username', $data['message']['chat']['username'], PDO::PARAM_STR);
        $result->bindParam(':user_id', $data['message']['chat']['id'], PDO::PARAM_STR);

        return $result->execute();
    }
}