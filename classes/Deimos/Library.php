<?php

namespace Deimos;

class Library
{

    protected static $_cache = array();

    private static $regxs = array(
        'name' => array(
            'en' => '/[^a-z]/i',
            'ru' => '/[^а-яё]/iu'
        )
    );

    public static function is_lang_ru($string)
    {
        return (bool)preg_match(self::$regxs['name']['ru'], $string);
    }

    public static function is_lang_en($string)
    {
        return (bool)preg_match(self::$regxs['name']['en'], $string);
    }

    public static function is_name($string)
    {
        if (empty($string))
            return false;
        return (bool)(self::is_lang_en($string) ^ self::is_lang_ru($string));
    }

    public static function is_datetime($datetime)
    {
        if (empty($datetime))
            return false;

        return (bool)strtotime($datetime);
    }

    public static function is_date($date)
    {
        if (empty($date))
            return false;

        return self::is_datetime($date);
    }

}