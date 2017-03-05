<?php

$template = template::getInstance();

//Делаем переключатель.
switch($_GET["page"]){
	//Собираем странички
	case "admin":
		/*if( ! $user->isAdmin() ) {
			header("Location: /cabinet");
		}*/
		
		$template->addTitle("Админ-панель");
	
		$template->addFile("headers.php");
		$template->addFile("cabinet-header.php");
		$template->addFile("cabinet-admin.php");
		$template->addFile("cabinet-sidebar.php");
		$template->addFile("footer.php");
		break;

	case "index":
	default:	
		$template->addFile("header.tpl");
		$template->addFile("categories.tpl");
		$template->addFile("footer.tpl");
        break;
        
    case "regist":
    default:
        $template->addFile("regist.tpl");
        break;
    case "author":
    default:
        $template->addFile("author.tpl");
        break;    
}