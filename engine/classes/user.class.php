<?php

class User{

	private $sess = array();

	public function __construct(){
		global $_SESSION;
		$this->sess = $_SESSION;
	}
	
	public function getLogin(){
		return $this->sess["login"];
	}
	
	public function getId(){
		return $this->sess["id"];
	}
	
	public function isLogged(){
		return $this->sess["auth"];
	}
	
	public function isAdmin(){
		if($this->sess["rank"] >= 10) 
			return true;
		else
			return false;
	}

	public function login($login, $pass){
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
		} else {
			return ("Неверный пароль. Проверьте раскладку, и не нажат ли <b>Caps Lock</b>");
		}
	}
	
	public function register($login, $pass, $repass, $email){
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
		} else {
			return ("Ошибка базы данных. Пожалуйста, покажите ошибку нашему системному администратору. Код ошибки:" . mysql_error());
		}
	}
	
	public function logout(){
		unset($this->sess);
		session_destroy();
		return true;
	}

}