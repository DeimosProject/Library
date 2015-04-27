<?php
mb_internal_encoding('utf-8');
include_once "autoload.php";

use Deimos\Form;

$emails = array(
    'почта@привет.мир',
    'maksim.babichev95@gmail.com',
    'ad@spa.com',
    '(comment)localpart@example.com',
    'localpart.ending.with.dot.@example.com',
    '"this is v@lid!"@example.com',
    '"much.more unusual"@example.com',
    'postbox@com',
    'admin@mailserver1',
    '"()<>[]:,;@\\"\\\\!#$%&\'*+-/=?^_`{}| ~.a"@example.org',
    '" "@example.org',
    '0hot\'mail_check@hotmail.com'
);

foreach($emails as $email) {

    $f = new Form(['email' => $email]);
    var_dump($f);
}


die;

$server_requerst = isset($_SERVER['REQUEST_METHOD']) ? $_SERVER['REQUEST_METHOD'] : null;

if ($server_requerst == 'POST') {

    $form = new Form($_POST);

    include_once "form/Result.php";

}
else {

    include_once "form/Form.php";
}
