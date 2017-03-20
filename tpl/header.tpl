<!DOCTYPE html>
<html><head>
    <meta charset="utf-8">
    <title>{header_title}</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
	
	 <!-- Подключаем css -->
	<link href="/tpl/css/style.css" rel="stylesheet">

    <!-- HTML5shiv will help u, IE -->
    <!--[if lt IE 9]>
		<script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
    <![endif]-->

    <link rel="shortcut icon" href="/tpl/img/favicon.ico">
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
            <?php {isLogged} ?>
            <div class="right">
                <ul class="hr">
                    <li><a href="/">Пользователь</a></li>
                    <li><a href="/">Выход</a></li>
                </ul>  
            </div>
            {else}
            <div class="right">
                <ul class="hr">
                    <li><a href="/">Авторизация</a></li>
                    <li><a href="/">Регистрация</a></li>
                </ul>  
            </div>
            {end}
        </div>