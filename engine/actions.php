<?php

require_once("engine.php");

//Switch do actions
switch($_GET["do"]){

	//Add order
	case "add-order":
		foreach($_POST["values"] as $key => $value){
			$a[$key] = $db->secure($value);
		}
		if($a["title"] && $a["desc"] && $a["price"]){
			if(!preg_match("/[0-9]/i", $a["price"] )) {
				die("Введите реальную цену");
			}
			
			$result = $order->addOrder($a["title"], $a["desc"], $a["price"]);
			if( $result === true ) {
				die("1");
			} else {
				die($result);
			}
		} else {
			die("Заполните все поля!");
		}
	break;
	
	//Login
	case "login":
		foreach($_POST["values"] as $key => $value){
			$a[$key] = $db->secure($value);
		}
		if($a["login"] && $a["password"]){
			$result = $user->login($a["login"], $a["password"]);
			if( $result === true ) {
				$_SESSION["auth"] = true;
				$_SESSION["login"] = $a["login"];
				die("1");
			} else {
				die($result);
			}
		} else {
			die("Заполните все поля!");
		}
	break;
	
	//Exit
	case "exit":
		if( $user->logout() ){
			die("1");
		}
	break;

	//Registration
	case "reg":
		foreach($_POST["values"] as $key => $value){
			$a[$key] = $db->secure($value);
		}
		if($a["login"] && $a["password"] && $a["e-mail"]){
			$result = $user->register($a["login"], $a["password"], $a["e-mail"]);
			if( $result === true ) {
				$_SESSION["auth"] = true;
				$_SESSION["login"] = $a["login"];
				die("1");
			} else {
				die($result);
			}
		} else {
			die("Заполните все поля!");
		}
	break;
		
	default: break;
}