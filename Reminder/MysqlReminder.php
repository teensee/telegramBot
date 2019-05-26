<?php

namespace Reminder;

use BotClient\DataWorker;

class MysqlReminder
{
    public static function selectUniqueRecord()
    {
        $messages = DataWorker::selectMessage();

        if(count($messages) == 0){
            DataWorker::dropAllUsedMarkers();
            unset($messages);
            $messages = DataWorker::selectMessage();
        }

        $randomValue = rand(0, count($messages)-1);

        DataWorker::markSelectedMessage($messages[$randomValue]['id']);

        return $messages[$randomValue]['text'];
    }
}