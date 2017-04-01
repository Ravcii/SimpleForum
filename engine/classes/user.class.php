<?php

class User {
	public function login($login, $pass){
<<<<<<< HEAD
        //Используем переменную БД.
        global $db;
        
		// Проверки на корректность данных.
		if(!preg_match("/[0-9a-z_A-Z]/i", $login)){
			return "Логин должен состоять из английских букв и цифр 0-9.";
		} else if(!preg_match("/[0-9a-z_A-Za-яA-ЯёЁ]/i", $pass)) {
			return "Пароль должен состоять из цифр и русских и английских букв.";
		} else if($db->query("SELECT `login` FROM `users` WHERE `login` = '".$login."'")->num_rows == 0){
			return "Пользователя с логином <b>".$login."</b> не существует.";
		}
        
        //Процесс авторизации
		
		$user_data = $db->query("SELECT * FROM `users` WHERE `login` = '{$login}'")->fetch_assoc();
			
		if(md5($pass) == $user_data["password"]) {
			return "Добро пожаловать!";
=======
		global $db;
		//Login check
        if(!preg_match("/[0-9a-z_A-Z]/i", $login)){
            return ("Логин должен состоять из английских букв и цифр 0-9!");
        }

        //Password check
        if(!preg_match("/[0-9a-z_A-Z\?\*\-\_\@\#]/i", $pass) && !preg_match("/[0-9a-z_A-Z\?\*\-\_\@\#]/i", $pass)) {
            return ("Пароль может состоять из английских букв, цифр и символов \"?*-_@#\"!");
        }

		//All field's fill correctly
		//Continue

		//User with that login exists?
		if( ! $db->query("SELECT `login` FROM `users` WHERE `login` = '".$login."'")->num_rows >= 1 ){
			return "Пользователя с таким логином <b>".$login."</b> не существует!";
		}

		$pass_db = $db->query("SELECT `password` FROM `users` WHERE `login` = '".$login."'");

		//echo $pass_db;
		//Registration

		$pass_hash = hash("sha512", $pass);
        //echo $pass_hash;
		if($pass_hash == $pass_db) {
			return true;
>>>>>>> origin/Artur
		} else {
			return "Неверный пароль. Проверьте раскладку, и не нажат ли <b>Caps Lock</b>";
		}
	}
	
	public function register($login, $pass, $repass, $email){
<<<<<<< HEAD
        //Используем переменную БД.
        global $db;
        
		// Проверки на корректность данных.
		if(!preg_match("/[0-9a-z_A-Z]/i", $login)){
			return "Логин должен состоять из английских букв и цифр 0-9.";
		} else if(!preg_match("/[0-9a-z_A-Za-яA-ЯёЁ]/i", $pass)) {
			return "Пароль может состоять из английских букв, цифр и символов \"?*-_@#\".";
		} else if(!preg_match("/[0-9a-z_]+@[0-9a-z_^\.-]+\.[a-z]{2,3}/i", $email)) {
			return "E-mail должно быть в формате: josh@doe.com.";
		} else if($db->query("SELECT `login` FROM `users` WHERE `login` = '".$login."'")->num_rows > 0 ){
			return "Кто-то уже зарегестрирован с логином <b>".$login."</b>.";
		} else if($db->query("SELECT `email` FROM `users` WHERE `email` = '".$email."'")->num_rows > 0 ) {
			return "Кто-то уже зарегестрирован с адресом <b>".$email."</b>.";
		} else if($pass != $repass){
            return "Пароли не совпадают.";
        }
			
		//Процесс регистрации
        
		$pass = md5($pass);
		if($db->query("INSERT INTO `users` (login, password, email) VALUES ('{$login}', '{$pass}', '{$email}');")) {
			return "Аккаунт <b>".$login."</b> (".$email.") был зарегистрирован.";
=======
		global $db;
		//Login check
		if(!preg_match("/[0-9a-z_A-Z]/i", $login)){
			return ("Логин должен состоять из английских букв и цифр 0-9!");
		} 
		
		//Password check
		if(!preg_match("/[0-9a-z_A-Z\?\*\-\_\@\#]/i", $pass) && !preg_match("/[0-9a-z_A-Z\?\*\-\_\@\#]/i", $repass)) {
			return ("Пароль может состоять из английских букв, цифр и символов \"?*-_@#\"!");
		}
		
		//Email check
		if(!preg_match("/[0-9a-z_]+@[0-9a-z_^\.-]+\.[a-z]{2,3}/i", $email)) {
			return ("Неверно заполнено поле E-Mail!");
		} 
		
		//User with this username exists?
		if($db->query("SELECT `login` FROM `users` WHERE `login` = '".$login."'")->num_rows >= 1 ){
			return ("Кто-то уже зарегестрирован с никнеймом <b>".$login."</b>");
		}
			
		//User with this e-mail exists?
		if($db->query("SELECT `email` FROM `users` WHERE `email` = '".$email."'")->num_rows >= 1 ) {
			return ("Кто-то уже зарегестрирован с адресом <b>".$email."</b>");
		}
        
        if($pass != $repass){
            return ("Пароли не совпадают.");
        }
			
		//Registration
		$pass = md5($pass);
		if($db->query("INSERT INTO `users` (login, password, email) VALUES ('{$login}', '{$pass}', '{$email}');")) {
			return ("Аккаунт <b>".$login."</b> (".$email.") был зарегистрирован.");
>>>>>>> origin/Artur
		} else {
			return "Ошибка базы данных. Пожалуйста, покажите ошибку нашему системному администратору. Код ошибки:" . mysql_error();
		}
	}
}