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
        if (isset(self::$_cache['phone'][$string]))
            return self::$_cache['phone'][$string];
        self::$_cache['phone'][$string] = preg_replace(self::$regx_phone, '', $string);
        $length = strlen(self::$_cache['phone'][$string]);
        return $length == 10 || $length == 11;
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