<?php

class JokeSelector
{

    private $itterator = null;
    private $usedNumbers = [];

    public $jokes = [
        "В пустыне не столько хочется пить, сколько чтоб верблюд не натирал!",
        "Жираф — это лошадь, выполненная по всем требованиям заказчика",
        "Если вас топят соседи снизу, значит у них там ваще пиздос!",
        "Даже самый суеверный сотрудник не откажется от 13-й зарплаты",
        "Певица Максим назвала своего сына Машенька",
        "Человеку с очень сексуальным голосом неловко разговаривать с детьми и бабушками.",
        "80-летняя Клавдия Васильевна прыгнула с парашютом. Как говорится, годы летят.",
        "Открылась социальная сеть «Бабушки на лавочке». Основные кнопки сайта: «Добавить в наркоманы» и «Добавить в проститутки»",
        "У него была острая интеллектуальная недостаточность.",
    ];

    public function __construct()
    {
        $this->itterator = 0;
    }


    public function getNewJoke()
    {
        if (!count($this->usedNumbers)) {
            $this->itterator = rand(0, count($this->jokes) - 1);
            array_push($this->usedNumbers, $this->itterator);
            return $this->jokes[$this->itterator];
        } else {
            while (true) {
                $this->itterator = rand(0, count($this->jokes) - 1);
                if (!in_array($this->itterator, $this->usedNumbers)) {
                    array_push($this->usedNumbers, $this->itterator);
                    return $this->jokes[$this->itterator];
                    break;
                }
            }
        }
    }

}