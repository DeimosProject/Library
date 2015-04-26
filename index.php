<?php
mb_internal_encoding('utf-8');
include_once "autoload.php";

use Deimos\Form;

$form = new Form(array('email' => '"()<>[]:,;@\\"!#$%&\'*+-/=?^_`{}| ~.a"@example.org'));
var_dump($form);die;

$server_requerst = isset($_SERVER['REQUEST_METHOD']) ? $_SERVER['REQUEST_METHOD'] : null;

if ($server_requerst == 'POST') {

    $form = new Form($_POST);

    include_once "form/Result.php";

}
else {

    include_once "form/Form.php";
}
