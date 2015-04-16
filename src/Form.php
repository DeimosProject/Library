<?php

class Form
{

    /**
     * @param string $string
     * @return bool
     */
    public static function is_phone($string)
    {
        $string = preg_replace('/[^\d]/i', '', $string);
        $length = strlen($string);
        return $length == 10 || $length == 11;
    }

}