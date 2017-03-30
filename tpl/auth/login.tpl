<!DOCTYPE html> 
<html> 
<head> 
    <meta charset="utf-8"> 
    <title>Регистрация</title> 
    <link href="/tpl/css/style_auth.css" rel="stylesheet"> 
</head> 
<body>
    <div id="login">
        <form action="/login" method="POST">
            <input type="hidden" name="action" value="1" />
            <p>
                <span class="fontawesome-user"></span>
                <input 
                    type="text"
                    name="login"
                    pattern="^[0-9a-zA-Z_]+$"
                    title="Логин должен состоять из английских букв и цифр 0-9."
                    placeholder="Имя пользователя" 
                    required
                />
            </p> 
            <p>
                <span class="fontawesome-lock"></span>
                <input
                    type="password"
                    name="password"
                    pattern="[0-9a-z_A-Z\?\*\-\_\@\#]"
                    title="Пароль может состоять из английских букв, цифр и символов \"?*-_@#\"."
                    placeholder="Пароль"
                    required
                />
            </p> 
            <p><input type="submit" value="ВОЙТИ"></p>
        </form>
    </div>
</body>
</html>