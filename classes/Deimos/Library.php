<?php

namespace Deimos;

class Library
{

    protected static $_cache = array();

    private static $regxs = array(
        'phone' => '/[^\d]/i',
        'name' => array(
            'en' => '/[^a-z]/i',
            'ru' => '/[^а-я]/iu'
        )
    );

    public static function phone($string)
    {

        if (empty($string))
            return '';

        if (isset(self::$_cache['phone'][$string]))
            return self::$_cache['phone'][$string];

        $phone = &self::$_cache['phone'][$string];
        $phone = preg_replace(self::$regxs['phone'], '', $string);

        $length = strlen($phone);
        switch ($length) {
            case 10:
                $char = substr($phone, 0, 1);
                $phone = 8 . $phone;
                if ($char == 7) {
                    $phone = '';
                }
                break;
            case 11:
                $phone = 8 . substr($phone, 1);
                break;
            default:
                $phone = '';
        }

        return $phone;

    }

    public static function is_phone($string)
    {

        if (empty($string))
            return false;

        if (isset(self::$_cache['is_phone'][$string]))
            return self::$_cache['is_phone'][$string];

        $phone = self::phone($string);

        $is_phone = &self::$_cache['is_phone'][$string];
        $is_phone = strlen($phone) == 11;
        return $is_phone;

    }

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