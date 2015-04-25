# Library

// FORM.PHP

   <!DOCTYPE HTML>
   <html>
       <head>
           <title>Форма</title>
           <meta charset="utf-8" />
       </head>
       <body>
           <form method="POST" action="">
               <div>
                   <label for="lastname">Фамилия</label>
                   <input id="lastname" type="text" name="lastname" />
               </div>
               <div>
                   <label for="name">Имя</label>
                   <input id="name" type="text" name="name" />
               </div>
               <div>
                   <label for="email">E-mail</label>
                   <input id="email" type="text" name="email" />
               </div>
               <div>
                   <label for="phone">Телефон</label>
                   <input id="phone" type="tel" name="phone" />
               </div>
               <input type="submit" value="Валидация" />
           </form>
       </body>
   </html>

// INDEX.PHP

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