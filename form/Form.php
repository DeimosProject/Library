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
            <div>
                <label for="domain">Домен</label>
                <input id="domain" type="text" name="domain" />
            </div>
            <div>
                <label for="password">Пароль</label>
                <input id="password" type="password" name="password" />
            </div>
            <div>
                <label for="password_confirm">Подтвердите</label>
                <input id="password_confirm" type="password" name="password_confirm" />
            </div>
            <input type="submit" value="Валидация" />
        </form>
    </body>
</html>