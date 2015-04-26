<?php

if (isset($form)) {
    if ($form->is_valid()) {
        var_dump('Данные введены корректно!');
    }
    else {
        var_dump($form);
    }
}
else {
    var_dump('Нет данных');
}