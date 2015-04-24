<?php

class Library
{

    protected static $_cache = array();

    private static $regxs = array(
        'phone' => '/[^\d]/i',
        'email' => '/[^@]{1,}[@]{1}[^@]{1,}/ui',
        'name' => array(
            'en' => '/[^a-z]/i',
            'ru' => '/[^а-я]/iu'
        )
    );

    /**
     * @param $string
     * @param int $len
     * @param int $begin
     * @return mixed|string
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
                $char = substr($phone, 0, 1);
                if ($char == 7 || $char == 8) {
                    $phone = '';
                }
                else {
                    $phone = 8 . $phone;
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

    public static function is_name($string)
    {
        $en = (bool)preg_match(self::$regxs['name']['en'], $string);
        $ru = (bool)preg_match(self::$regxs['name']['ru'], $string);
        return (bool)($en ^ $ru);
    }

    public static function is_email($string)
    {
        $bool = (bool)preg_match(self::$regxs['email'], $string, $array_emails);
        $is_one = count($array_emails) == 1;
        $length_equal = false;
        if ($is_one)
            $length_equal = mb_strlen($string) == mb_strlen($array_emails[0]);
        return $bool && $length_equal;
    }

    public static function is_datetime($datetime)
    {
        return (bool)strtotime($datetime);
    }

    public static function is_date($date)
    {
        return self::is_datetime($date);
    }

}