<?php

$template = template::getInstance();

$_page = $_GET["page"];

//Делаем переключатель.
switch($_page){
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
	
	case "orders-add":
		if( ! $user->isLogged() ) {
			header("Location: /");
		}
		
		$template->addTitle("Личный кабинет");
		$template->addTitle("Сделать заказ");
	
		$template->addFile("headers.php");
		$template->addFile("cabinet-header.php");
		$template->addFile("cabinet-orders-add.php");
		$template->addFile("cabinet-sidebar.php");
		$template->addFile("footer.php");
	break;
	
	case "orders":
		if( ! $user->isLogged() ) {
			header("Location: /");
		}
		
		$template->addTitle("Личный кабинет");
		$template->addTitle("Ваши заказы");
	
		$template->addFile("headers.php");
		$template->addFile("cabinet-header.php");
		$template->addFile("cabinet-orders.php");
		$template->addFile("cabinet-sidebar.php");
		$template->addFile("footer.php");
	break;
	
	case "settings":
		if( ! $user->isLogged() ) {
			header("Location: /");
		}
		
		$template->addTitle("Личный кабинет");
		$template->addTitle("Настройки");
	
		$template->addFile("headers.php");
		$template->addFile("cabinet-header.php");
		$template->addFile("cabinet-settings.php");
		$template->addFile("cabinet-sidebar.php");
		$template->addFile("footer.php");
	break;
	
	case "cabinet":
		if( ! $user->isLogged() ) {
			header("Location: /");
		}

		$template->addTitle("Личный кабинет");
		
		$template->addFile("headers.php");
		$template->addFile("cabinet-header.php");
		$template->addFile("cabinet-main.php");
		$template->addFile("cabinet-sidebar.php");
		$template->addFile("footer.php");
	break;
	
	default:	
		if( $user->isLogged() ) {
			header("Location: /cabinet");
		}
		
		$template->addFile("headers.php");
		$template->addFile("main.php");
		$template->addFile("footer.php");
		$template->addFile("modal-register.php");
		$template->addFile("modal-login.php");
	break;
}