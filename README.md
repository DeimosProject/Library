# Library

// FORM.PHP

    input id="lastname" type="text" name="lastname"
    input id="name" type="text" name="name"
    input id="email" type="text" name="email"
    input id="phone" type="tel" name="phone"

// INDEX.PHP

    include_once "src/autoload.php";

    $server_requerst = isset($_SERVER['REQUEST_METHOD']) ? $_SERVER['REQUEST_METHOD'] : null;

    if ($server_requerst == 'POST') {

        $form = new Form($_POST);
        if ($form->is_valid()) {
            var_dump('Данные введены корректно!');
        }
        else {
            var_dump('Ошибка ввода данных');
        }

    }
    else {

        include_once "form/Form.php";
    }