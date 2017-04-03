<?php
//Делаем переключатель.
switch($_GET["page"]){
    
    //Главная страница
	case "index":
	default:
        $template->addTitle("Главная страница");
    
		$template->addFile("header.tpl");
		$template->addFile("/categories/categories.tpl");
		$template->addFile("footer.tpl");
        
        $template->replaceString("{categories}", Categories::getCategoriesAsHtml());
        break;
        
    //Страница секции (Выбор темы либо раздела)
    case "section":
        $id = $db->real_escape_string($_GET["id"]);
        $sectionTitle = Section::getTitle($id);
    
        $template->addTitle($sectionTitle);

        $template->addFile("header.tpl");
        $template->addFile("/section/section.tpl");
        $template->addFile("footer.tpl");
        
        $subCatHtml = Section::getSubCategoriesAsHtml($id);
        if($subCatHtml != ""){
            $template->replaceString("{categories_placer}", $subCatHtml);
        } else {
            $template->replaceString("{categories_placer}", "");
        }
        
        $topicsHtml = Section::getTopicsAsHtml($id);
        if($topicsHtml != ""){
            $template->replaceString("{topics_placer}", $topicsHtml);
        } else {
            $template->replaceString("{topics_placer}", "");
        }
        break;
        
    //Страница с темой
	case "topic":
        $id = $db->real_escape_string($_GET["id"]);
        $topicTitle = Topic::getTitle($id);
    
		$template->addTitle($topicTitle);
		
		$template->addFile("header.tpl");
		$template->addFile("/topic/topic.tpl");
		$template->addFile("footer.tpl");
        
        $template->replaceString("{topic_title}", $topicTitle);
        $template->replaceString("{user_messages}", Topic::getUserMessagesAsHtml($id));
		break;
        
    //Регистрация
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
     
    //Авторизация
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