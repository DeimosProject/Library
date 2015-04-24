<?php

include_once "src/autoload.php";

var_dump(Library::is_email("maksim.babichev95@gmail.com"));
var_dump(Library::is_email("maksim-babichev95@gmail.com"));
var_dump(Library::is_email("привет5@gmail.com"));
var_dump(Library::is_email("Abc.example.com"));
var_dump(Library::is_email("A@b@c@example.com"));
var_dump(Library::is_email("a\"b(c)d,e:f;gi[j\\k]l@example.com"));
var_dump(Library::is_email("just\"not\"right@example.com"));

var_dump(Library::is_name('Максим'));
var_dump(Library::is_name('Бабичев'));

var_dump(Library::is_name('Maxim'));
var_dump(Library::is_name('Babichev'));

var_dump(Library::is_name('Mаxim'));
var_dump(Library::is_name('Bаbichev'));

$form = new Form($_GET);
$form->lastname->valid_name;
var_dump($form->is_valid());