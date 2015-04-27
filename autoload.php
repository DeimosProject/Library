<?php

function __autoload($class)
{
    $path = "classes/$class.php";
    $path = str_replace('\\', '/', $path);
    include_once $path;
}

class autoload
{

}