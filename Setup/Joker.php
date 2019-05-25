<?php

class Joker
{
    public static function getRandomFact()
    {
        $href = 'http://randstuff.ru/fact';
        $page = file_get_contents($href);
        preg_match("/<table. *class=\"text\"><tr><td>(.*)<\/td><\/tr><\/table>/", $page, $match);
        return $match[1];
    }
}