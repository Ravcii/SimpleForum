<?php
//Делаем переключатель.
switch($_GET["page"]){
	case "index":
	default:
        $template->addTitle("Главная страница");
    
		$template->addFile("header.tpl");
		$template->addFile("/categories/categories.tpl");
		$template->addFile("footer.tpl");
        
        $template->replaceString("{categories}", Categories::getCategoriesAsHtml());
        break;
        
	case "topic":
        $id = $db->real_escape_string($_GET["id"]);
    
		$template->addTitle("Тема");
		
		$template->addFile("header.tpl");
		$template->addFile("/topic/topic.tpl");
		$template->addFile("footer.tpl");
        
        $template->replaceString("{topic_title}", Topic::getTitle($id));
        $template->replaceString("{user_messages}", Topic::getUserMessagesAsHtml($id));
        
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
<<<<<<< HEAD
        $template->addFile("/auth/register.tpl");
    
        if($_POST["action"]){
            $msg = $user->register($_POST["login"], $_POST["password"], $_POST["password"], $_POST["email"]);
            $template->replaceString("{message}", $msg);
            $template->replaceString("{show}", "show");
        }
=======
        $template->addFile("register.tpl");
>>>>>>> origin/Artur
        break;
    case "login":
<<<<<<< HEAD
    
        $template->addTitle("Авторизация");
        $template->addFile("/auth/login.tpl");
        
        if($_POST["action"]){
            $msg = $user->login($_POST["login"], $_POST["password"]);
            $template->replaceString("{message}", $msg);
            $template->replaceString("{show}", "show");
        }
=======
        if($_POST["auth"] == "1"){
            $msg = $user->login($_POST["login"], $_POST["pass"]);
        }
        $_POST["login"];
        $_POST["pass"];

        $template->addTitle("Авторизация");
        $template->addFile("login.tpl");
>>>>>>> origin/Artur
        break;    
}

$template->replaceString("{header_title}", $template->getTitle());
/*
		$this->replaceString("{isAdmin}", "<?php if( $user->isAdmin() ) { ?>");
		$this->replaceString("{end}", "<?php } ?>");
        
        /* Раздел 
        //$this->template = str_replace("{sections}", Sections::getSectionsAsHtml(), $this->template);
        //$this->template = str_replace("{sections_theme}", Topics::getTopicsAsHtml(), $this->template);

		//Файловые репллейсеры
		//Пусть лежит для примера. Удалите как не будет нужен
		//$this->replaceFile("{user_block}", "user-panel.php");
		
		//Another preg Replace's
		//Я не помню для чего, пока оставим
		//$this->template = preg_replace("#\\{user\\[(.*?)\\]\\}#ies", "\$_SESSION['\\1']", $this->template);
*/