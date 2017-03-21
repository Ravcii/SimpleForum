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
        $template->addTitle("Регистрация");
        
        $template->addFile("register.tpl");
        break;
        
    case "login":
        $template->addTitle("Авторизация");
        
        $template->addFile("login.tpl");
        break;    
}