<?php

class mysql {	
	private static $_instance;
    private function __construct(){}
	private function __clone(){}
    public static function getInstance() {
        if ( is_null(self::$_instance) ) {
            self::$_instance = new self();
        }
        return self::$_instance;
    }
	
	//==================================================
	
	private $link = null;
	private $errors = null;
	
	public function connect($addr, $user, $pass, $name){
		$this->link = mysql_connect($addr, $user, $pass);
		mysql_select_db($name, $this->link);
		mysql_set_charset("utf8", $this->link);
	}
	
	public function query( $q ) {
		if ( isset( $this->link ) ) //проверяем, имеем ли мы подключение к БД
		{			
			$result = mysql_query( $q );
			
			$this->checkError();
		} else {
			$this->addError( "Соединение с базой данных не установлено" );
			
			//Чтобы вернул false
			$result = false;
		}
		
		return $result;
	}
	
	public function result( $q ){
		if ( isset( $this->link ) ) //проверяем, имеем ли мы подключение к БД
		{			
			$result = mysql_result( $this->query( $q ), 0 );
			
			$this->checkError();
		} else {
			$this->addError( "Соединение с базой данных не установлено" );
		}
		
		return $result;
	}
	
	public function secure($var){
		return mysql_real_escape_string(trim(addslashes($var)));
	}
	
	public function fetchArray ( $q ) {
		$result = mysql_fetch_assoc( $this->query($q) );
		
		$this->checkError();
		
		return $result;
	}
	
	public function numRows ( $q ) {
		$result = mysql_num_rows( $this->query($q) );
		
		$this->checkError();
		
		return (int)$result;
	}
	
	private function checkError(){
		if ( mysql_error() ){
			$this->addError( "Ошибка в MySQL запросе: ".mysql_error() );
			return false;
		} else {
			return true;
		}
	}
	
	private function addError( $err ) {
		$this->errors .= $err . "<br>\n";
	}
	
	public function getErrors() {
		return $this->errors;
	}
}