<?php

class Form
{

    protected static $_cache = array();

    private static $regxs = array(
        'phone' => '/[^\d]/i'
    );

    /**
     * @param string $string
     * @return bool
     */
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

    /**
     * @param string $string
     * @return string
     */
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
                $phone = 7 . $phone;
                break;
            case 11:
                $phone = 7 . substr($phone, 1);
                break;
            default:
                $phone = '';
        }

        return $phone;

    }

}