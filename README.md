# Library

// FORM.PHP
    input id="lastname" type="text" name="lastname"<br/>
    input id="name" type="text" name="name"<br/>
    input id="email" type="text" name="email"<br/>
    input id="phone" type="tel" name="phone"<br/>

// INDEX.PHP
    <?php

    include_once "src/autoload.php";

    $server_requerst = isset($_SERVER['REQUEST_METHOD']) ? $_SERVER['REQUEST_METHOD'] : null;

    if ($server_requerst == 'POST') {

        $form = new Form($_POST);

        $form->lastname->validate_name();

        if ($form->is_validate()) {
            var_dump('Данные введены корректно!');
        }
        else {
            var_dump('Ошибка ввода данных');
        }

    }
    else {

        include_once "form/Form.php";
    }