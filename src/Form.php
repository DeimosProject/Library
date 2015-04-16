<?php

class Form
{

    protected static $_cache = array();

    private static $regx_phone = '/[^\d]/i';

    /**
     * @param string $string
     * @return bool
     */
    public static function is_phone($string)
    {

        if (isset(self::$_cache['is_phone'][$string]))
            return self::$_cache['is_phone'][$string];

        self::$_cache['phone'][$string] = preg_replace(self::$regx_phone, '', $string);

        self::$_cache['is_phone'][$string] = strlen(self::$_cache['phone'][$string]);

        $is_equal_10 = self::$_cache['is_phone'][$string] == 10;
        $is_equal_11 = self::$_cache['is_phone'][$string] == 11;

        return $is_equal_10 || $is_equal_11;

    }

    /**
     * @param string $string
     * @return string
     */
    public static function phone($string)
    {

        if (isset(self::$_cache['phone'][$string]))
            return self::$_cache['phone'][$string];

        self::$_cache['phone'][$string] = preg_replace(self::$regx_phone, '', $string);
        return self::$_cache['phone'][$string];

    }

}