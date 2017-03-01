<?php
//Длинна сессии - 2 дня
session_set_cookie_params(2*24*60*60);
ini_set("session.gc_maxlifetime", 2*24*60*60);

//Запускаем сессию
session_start();

/**
Оставлю этот кусок на всякий случай. Нужен если собираемся собирать такую статистику, как "Последняя авторизация" и с какого айпишника был вход

//Если авторизова
if($user->isLogged()) {
	$info = $sql->fetchArray("SELECT `id`, `login`, `password`, `last_ip`, `rank`, `last_online` FROM `users` WHERE `login` = '".$user->getLogin()."'");
		foreach($info as $key => $value){
			$_SESSION[$key] = $value;
		}
		
		//Change ip, if user enter from another ip
		if($_SERVER["REMOTE_ADDR"] != $info["last_ip"]) {
			$sql->query("UPDATE `users` SET `last_ip` = '".$_SERVER["REMOTE_ADDR"]."' WHERE `login` = '".$info["login"]."'");
		}
		
		//Last online
		$time = time();
		if($time > ( 600 + $info["last_online"] )){
			$sql->query("UPDATE `users` SET `last_online` = '$time' WHERE `login` = '".$info["login"]."'");
		}
}
**/