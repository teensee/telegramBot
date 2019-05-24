<?php

namespace BotClient;
use PDO;

class DbConn
{
    public static function getConnection()
    {
        $paramsPath = "Setup/db_params.php";
        $params = include($paramsPath);

        $dsn = "mysql:host={$params['host']};dbname={$params['dbname']}";
        $db = new PDO($dsn, $params['user'], $params['password']);

        return $db;
    }
}