<?php

include_once "autoload.php";

use Deimos\Form;

$server_requerst = isset($_SERVER['REQUEST_METHOD']) ? $_SERVER['REQUEST_METHOD'] : null;

if ($server_requerst == 'POST') {

    $form = new Form($_POST);

    include_once "form/Result.php";

}
else {

    include_once "form/Form.php";
}
