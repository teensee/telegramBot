<?php


namespace BotClient;

use PDO;

class DataWorker
{
    public static function addUserToDb($data)
    {
        $db = DbConn::getConnection();

        $sql = "INSERT INTO active_users(first_name, username, language_code, chat_id, chat_first_name, chat_username, user_id, chat_last_name, from_last_name)
            VALUES(:first_name, :username, :language_code, :chat_id, :chat_first_name, :chat_username, :user_id, :chat_last_name, :from_last_name)";

        $result = $db->prepare($sql);

        $result->bindParam(':first_name', $data['message']['from']['first_name'], PDO::PARAM_STR);
        $result->bindParam(':username', $data['message']['from']['username'], PDO::PARAM_STR);
        $result->bindParam(':language_code', $data['message']['from']['language_code'], PDO::PARAM_STR);
        $result->bindParam(':chat_id', $data['message']['chat']['id'], PDO::PARAM_STR);
        $result->bindParam(':chat_first_name', $data['message']['chat']['first_name'], PDO::PARAM_STR);
        $result->bindParam(':chat_username', $data['message']['chat']['username'], PDO::PARAM_STR);
        $result->bindParam(':user_id', $data['message']['from']['id'], PDO::PARAM_STR);
        $result->bindParam(':from_last_name', $data['message']['from']['last_name'], PDO::PARAM_STR);
        $result->bindParam(':chat_last_name', $data['message']['chat']['last_name'], PDO::PARAM_STR);

        unset($db);
        return $result->execute();
    }

    public static function selectMessage()
    {
        $db = DbConn::getConnection();

        $sql = "SELECT id, text, used FROM aero_reminder WHERE used = 0";

        $result = $db->query($sql)->fetchAll();

        unset($db);
        return $result;
    }

    public static function markSelectedMessage(int $id){
        $db = DbConn::getConnection();

        $sql = "UPDATE aero_reminder SET used = 1 WHERE id=?";
        $db->prepare($sql)->execute([$id]);
    }

    public static function dropAllUsedMarkers(){
        $db = DbConn::getConnection();

        $sql = "UPDATE aero_reminder SET used = 0";
        $db->prepare($sql)->execute();

        unset($db);

    }
}