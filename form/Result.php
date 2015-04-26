<?php

if (isset($form)) {
    if ($form->is_valid()) {
        var_dump('Данные введены корректно!');
    }
    else {
        var_dump('Ошибка ввода данных');
    }
}
else {
    var_dump('Нет данных');
}