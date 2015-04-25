<?php

include_once "src/autoload.php";

$server_requerst = isset($_SERVER['REQUEST_METHOD']) ? $_SERVER['REQUEST_METHOD'] : null;

if ($server_requerst == 'POST') {

    $form = new Form($_POST);

    $form->lastname->validate_name();

    include_once "form/Result.php";

}
else {

    include_once "form/Form.php";
}
