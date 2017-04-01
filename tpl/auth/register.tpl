<!DOCTYPE html> 
<html> 
<head> 
    <meta charset="utf-8"> 
    <title>Регистрация</title> 
    <link href="/tpl/css/style_registration.css" rel="stylesheet"> 
</head> 
<body>
    <div id="login">
        <form action="/register" method="POST">
            <input type="hidden" name="reg" value="1" />
            <p>
                <span class="fontawesome-user"></span>
                <input 
                    type="text"
                    name="login"
                    pattern="^[0-9a-zA-Z_]+$"
                    title="Логин должен состоять из английских букв и цифр 0-9!"
                    placeholder="Имя пользователя" 
                    required
                />
            </p> 
            <p>
                <span class="fontawesome-envelope"></span>
                <input type="email" name="email" placeholder="E-Mail" required></p> 
            <p>
                <span class="fontawesome-lock"></span>
                <input type="password" name="pass" placeholder="Пароль" required></p> 
            <p>
                <span class="fontawesome-lock"></span>
                <input type="password" name="repass" placeholder="Еще раз пароль" required>
            </p> 
            <p><input type="submit" value="ЗАРЕГИСТРИРОВАТЬСЯ"></p>
        </form>
    </div>
</body>
</html>