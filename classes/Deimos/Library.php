<?php

namespace Deimos;

class Library
{

    protected static $_cache = array();

    public static function is_lang_ru($string)
    {
        return (bool)preg_match('/[а-яё]/iu', $string);
    }

    public static function is_lang_en($string)
    {
        return (bool)preg_match('/[a-z]/i', $string);
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