<?php
//Делаем переключатель.
switch($_GET["page"]){
	case "index":
	default:
        $template->addTitle("Главная страница");
    
		$template->addFile("header.tpl");
		$template->addFile("/categories/categories.tpl");
		$template->addFile("footer.tpl");
        break;
	case "topic":
		$template->addTitle("Тема");
		
		$template->addFile("header.tpl");
		$template->addFile("/topic/topic.tpl");
		$template->addFile("footer.tpl");
		break;
    case "section":
        $template->addTitle("Раздел");

        $template->addFile("header.tpl");
        $template->addFile("/section/sections.tpl");
        $template->addFile("footer.tpl");
        break;
    case "register":
        if($_POST["reg"] == "1"){
            //Сама рега проходит в функции ниже, и на рутерн оно выдаёт сообщение с результатом, которое надо выводить пользователю, но это в TODO.
            $msg = $user->register($_POST["login"], $_POST["pass"], $_POST["repass"], $_POST["email"]);

        }

        $template->addTitle("Регистрация");
        $template->addFile("register.tpl");
        break;
    case "login":
        if($_POST["auth"] == "1"){
            $msg = $user->login($_POST["login"], $_POST["pass"]);
        }
        $_POST["login"];
        $_POST["pass"];

        $template->addTitle("Авторизация");
        $template->addFile("login.tpl");
        break;    
}