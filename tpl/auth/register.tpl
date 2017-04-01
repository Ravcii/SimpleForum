<!DOCTYPE html> 
<html> 
<head> 
    <meta charset="utf-8"> 
    <title>{header_title}</title> 
    <link href="/tpl/css/style_auth.css" rel="stylesheet"> 
</head> 
<body>
    <div id="message" class="{show}">{message}</div>
    <div id="login">
        <form action="/register" method="POST">
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
                <span class="fontawesome-envelope"></span>
                <input 
                    type="email"
                    name="email"
                    pattern="^[0-9a-z_]+@[0-9a-z_^\.-]+\.[a-z]{2,3}$"
                    title="Поле должно быть в формате: josh@doe.com."
                    placeholder="E-Mail"
                    required
                />
            </p> 
            <p>
                <span class="fontawesome-lock"></span>
                <input
                    type="password"
                    name="password"
                    pattern="^[0-9a-z_A-Za-яA-ЯёЁ]+$"
                    title="Пароль должен состоять из цифр и русских и английских букв."
                    placeholder="Пароль"
                    required
                />
            </p> 
            <p>
                <span class="fontawesome-lock"></span>
                <input
                    type="password"
                    name="repassword"
                    pattern="^[0-9a-z_A-Za-яA-ЯёЁ]+$"
                    title="Пароль должен состоять из цифр и русских и английских букв."
                    placeholder="Повторите пароль"
                    required
                />
            </p> 
            <p><input type="submit" value="ЗАРЕГИСТРИРОВАТЬСЯ"></p>
        </form>
    </div>
</body>
</html>