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
                    <li><a href="/" class="header_button">Главная страница</a></li>
                </ul>    
            </div>
            <div class="right">
                <ul class="hr">
                    {ifLogged}
                        <li><a href="#" class="header_button">{user[login]}</a></li>
                        <li><a href="/logout" class="header_button">Выход</a></li>
                    {else}
                        <li><a href="/login" class="header_button">Авторизация</a></li>
                        <li><a href="/register" class="header_button">Регистрация</a></li>
                    {end}
                </ul>  
            </div>
        </div>
        <div id="content">