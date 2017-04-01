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
        if($_SESSION["auth"]){
            header("Location: /");
        }
    
        $template->addTitle("Регистрация");
        $template->addFile("/auth/register.tpl");
    
        if($_POST["action"]){
            $msg = User::register($_POST["login"], $_POST["password"], $_POST["password"], $_POST["email"]);
            $template->replaceString("{message}", $msg);
            $template->replaceString("{show}", "show");
        }
        break;
        
    case "login":
        if($_SESSION["auth"]){
            header("Location: /");
        }
    
        $template->addTitle("Авторизация");
        $template->addFile("/auth/login.tpl");
        
        if($_POST["action"]){
            $msg = User::login($_POST["login"], $_POST["password"]);
            $template->replaceString("{message}", $msg);
            $template->replaceString("{show}", "show");
        }
        break;  
            
    case "logout":
        User::logout();
        break;
}

//Глобальные репллейсеры, которые нужны на многих страницах.
$template->replaceString("{header_title}", $template->getTitle());

$template->replaceString("{ifLogged}", "<?php if(\$_SESSION['auth']) {  ?>");
$template->replaceString("{else}", "<?php } else { ?>");
$template->replaceString("{end}", "<?php } ?>");

$template->replacePregString("#\\{user\\[(.*?)\\]\\}#ies", "\$_SESSION['\\1']");
        
 /*       
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