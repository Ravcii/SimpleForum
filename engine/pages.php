<?php
//Делаем переключатель.
switch($_GET["page"]){
	case "index":
	default:
        $template->addTitle("Главная страница");
    
		$template->addFile("header.tpl");
		$template->addFile("categories.tpl");
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