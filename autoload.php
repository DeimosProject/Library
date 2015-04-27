<?php

mb_internal_encoding('utf-8');

function __autoload($class)
{
    if (substr($class, 0, 5) != 'tests') {
        $path = "classes/$class.php";
        $path = str_replace('\\', '/', $path);
        include_once $path;
    }
    else {
        $path = "$class.php";
        $path = str_replace('\\', '/', $path);
        include_once $path;
    }
}

class autoload {}