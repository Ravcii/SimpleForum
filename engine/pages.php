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
        if($_POST["action"]){
            $msg = $user->register($_POST["login"], $_POST["password"], $_POST["password"], $_POST["email"]);
            echo $msg;
        }
    
        $template->addTitle("Регистрация");
        $template->addFile("/auth/register.tpl");
        break;
        
    case "login":
        if($_POST["action"]){
            $msg = $user->login($_POST["login"], $_POST["password"]);
            echo $msg;
        }
    
        $template->addTitle("Авторизация");
        $template->addFile("/auth/login.tpl");
        break;    
}