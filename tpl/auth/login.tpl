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
        <form action="/login" method="POST">
            <input type="hidden" name="action" value="1" />
            <p>
                <span class="fontawesome-user"></span>
                <input 
                    type="text"
                    name="login"
                    pattern="^[0-9a-zA-Z_]+$"
                    title="Логин должен состоять из английских букв и цифр."
                    placeholder="Имя пользователя" 
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
            <p><input type="submit" value="ВОЙТИ"></p>
        </form>
    </div>
</body>
</html>