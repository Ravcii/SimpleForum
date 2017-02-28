<?php

class user{

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
			return "Логин должен состоять из английских букв и цифр 0-9!";
		} 
		
		//Password check
		if(!preg_match("/[0-9a-z_A-Z\?\*\-\_\@\#]/i", $pass)) {
			return "Пароль может состоять из английских букв, цифр и символов \"? * - _ @ #\"!";
		}
		
		//All field's fill correctly
		//Continue
		
		//User with that login exists?
		if( ! $db->numRows("SELECT `login` FROM `users` WHERE `login` = '".$login."'") ){
			return "Пользователя с логином <b>".$login."</b> не существует!";
		}
		
		$pass_db = $db->result("SELECT `password` FROM `users` WHERE `login` = '".$login."'");
			
		//Registration
		$pass_hash = hash("sha512", $pass);
		if($pass_hash == $pass_db) {
			return true;
		} else {
			return ("Неверный пароль. Проверьте раскладку, и не нажат ли <b>Caps Lock</b>");
		}
	}
	
	public function register($login, $pass, $email){
		global $db;
		//Login check
		if(!preg_match("/[0-9a-z_A-Z]/i", $login)){
			return ("Логин должен состоять из английских букв и цифр 0-9!");
		} 
		
		//Password check
		if(!preg_match("/[0-9a-z_A-Z\?\*\-\_\@\#]/i", $pass)) {
			return ("Пароль может состоять из английских букв, цифр и символов \"? * - _ @ #\"!");
		}
		
		//Email check
		if(!preg_match("/[0-9a-z_]+@[0-9a-z_^\.-]+\.[a-z]{2,3}/i",$email)) {
			return ("Неверно заполнено поле E-Mail!");
		} 
		
		//All field's fill correctly
		//Continue
		
		//User with this username exists?
		if($db->numRows("SELECT `login` FROM `users` WHERE `login` = '".$login."'") >= 1 ){
			return ("Кто-то уже зарегестрирован с никнеймом <b>".$login."</b>");
		}
			
		//User with this e-mail exists?
		if($db->numRows("SELECT `email` FROM `users` WHERE `email` = '".$email."'") >= 1 ) {
			return ("Кто-то уже зарегестрирован с адресом <b>".$email."</b>");
		}
			
		//Registration
		$pass = hash("sha512", $pass);
		$time = time();
		$ip = $_SERVER["REMOTE_ADDR"];
		if($db->query("INSERT INTO `users` (id, login, password, email, last_ip, reg_ip, rank, last_online, created) 
								VALUES (NULL, '{$login}', '{$pass}', '{$email}', '{$ip}', '{$ip}', '0', '{$time}', '{$time}');"))
		{
			return true;
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