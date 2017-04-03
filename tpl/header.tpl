<!DOCTYPE html>
<html><head>
    <meta charset="utf-8">
    <title>{header_title}</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
	<link href="/tpl/css/style.css" rel="stylesheet">
    <link rel="shortcut icon" href="/tpl/img/favicon.ico">

    <!-- HTML5shiv will help u, IE -->
    <!--[if lt IE 9]>
		<script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
    <![endif]-->
</head>
<body>
    <div id="main">
        <div id="header_title">
            <div class="left">
                <ul class="hr">
                    <li><a href="/">Форум</a></li>
                    <li><a href="/">Пользователи</a></li>
                    <li><a href="/">Наша команда</a></li>
                </ul>    
            </div>
            <div class="right">
                <ul class="hr">
                    {ifLogged}
                        <li><a href="#">{user[login]}</a></li>
                        <li><a href="/logout">Выход</a></li>
                    {else}
                        <li><a href="/login">Авторизация</a></li>
                        <li><a href="/register">Регистрация</a></li>
                    {end}
                </ul>  
            </div>
        </div>
        <div id="content">