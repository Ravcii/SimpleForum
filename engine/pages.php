<?php
//Делаем переключатель.
$page = isset($_GET["page"]) ? $_GET["page"] : "index";
switch($page){
    
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

        $template->replaceString("{current_category_id}", $id);
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
        $topic_page = (isset($_GET["topic_page"])) ? $db->real_escape_string($_GET["topic_page"]) : 1;
        
        $topicTitle = Topic::getTitle($id);
		$template->addTitle($topicTitle);

		Topic::getCounterViewTopic($id);

		$template->addFile("header.tpl");
		$template->addFile("/topic/topic.tpl");
		$template->addFile("footer.tpl");

        
        if(isset($_POST["action"]) && $_POST["action"]){
            $msg = Topic::sendAnswer($id, $_SESSION["id"], $_POST["text"]);
            $template->replaceString("{message}", $msg);
            $template->replaceString("{show}", "show");
        }
        
        $template->replaceString("{topic_id}", $id);
        $template->replaceString("{topic_title}", $topicTitle);
        $template->replaceString("{pagination}", Topic::getPaginationAsHtml($id, $topic_page));
        $template->replaceString("{user_messages}", Topic::getUserMessagesAsHtml($id, $topic_page));
		break;
        
    //Страница с созданием темы
	case "new_topic":
        $pid = $db->real_escape_string($_GET["parent_id"]);
        
        if(!isset($_SESSION["auth"]) && !$_SESSION["auth"]){
            header("Location: /section.id={$pid}");
        }
    
		$template->addTitle(Section::getTitle($pid));
		$template->addTitle("Новая тема");
		
		$template->addFile("header.tpl");
		$template->addFile("/new_topic.tpl");

        if(isset($_POST["action"]) && $_POST["action"]){
            $msg = Topic::createTopic($_POST["title"], $_POST["text"], $_SESSION["id"], $pid);
            $template->replaceString("{message}", $msg);
            $template->replaceString("{show}", "show");
        }

        $template->replaceString("{pid}", $pid);
		break;
        
    //Регистрация
    case "register":
        if(isset($_SESSION["auth"]) && $_SESSION["auth"]){
            header("Location: /");
        }
    
        $template->addTitle("Регистрация");
        $template->addFile("/auth/register.tpl");
    
        if(isset($_POST["action"]) && $_POST["action"]){
            $msg = User::register($_POST["login"], $_POST["password"], $_POST["password"], $_POST["email"]);
            $template->replaceString("{message}", $msg);
            $template->replaceString("{show}", "show");
        }
        break;
     
    //Авторизация
    case "login":
        if(isset($_SESSION["auth"]) && $_SESSION["auth"]){
            header("Location: /");
        }
    
        $template->addTitle("Авторизация");
        $template->addFile("/auth/login.tpl");
        
        if(isset($_POST["action"]) && $_POST["action"]){
            $msg = User::login($_POST["login"], $_POST["password"]);
            $template->replaceString("{message}", $msg);
            $template->replaceString("{show}", "show");
        }
        break;
        
    case "settings":
        if(!isset($_SESSION["auth"]) && !$_SESSION["auth"]){
            header("Location: /");
        }
    
		$template->addTitle("Настройки");
		
		$template->addFile("header.tpl");
		$template->addFile("/settings.tpl");

        if(isset($_POST["action"]) && $_POST["action"]){
            $msg = "";
            if($_POST["pass"] != "" && $_POST["repass"] != ""){
                $msg = User::changePassword($_SESSION["id"], $_POST["pass"], $_POST["repass"]);
            }
            if($_FILES["avatar"]["tmp_name"] != "" && $_FILES["avatar"]["size"] > 0){
                $temp_msg = User::uploadAvatar($_SESSION["id"], $_FILES["avatar"]);
                $msg .= ($msg == "") ? $temp_msg : "<br>".$temp_msg;
            }
            if($msg != ""){
                $template->replaceString("{message}", $msg);
                $template->replaceString("{show}", "show");
            }
        }
    
        break;
            
    case "logout":
        User::logout();
        break;

}

//Глобальные репллейсеры, которые нужны на многих страницах.
$template->replaceString("{header_title}", $template->getTitle());

$template->replaceString("{ifLogged}", "<?php if(isset(\$_SESSION['auth']) && \$_SESSION['auth']) {  ?>");
$template->replaceString("{else}", "<?php } else { ?>");
$template->replaceString("{end}", "<?php } ?>");

$template->replaceString("{this_page}", $_SERVER['REQUEST_URI']);

if(isset($_SESSION["auth"])){
    $template->replacePregString("#\\{user\\[(.*?)\\]\\}#ies", "\$_SESSION['\\1']");
}