<?php

//Set session length - 2 Day's
session_set_cookie_params(2*24*60*60);
ini_set("session.gc_maxlifetime", 2*24*60*60);

//Start session
session_start();

//Update session value's
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