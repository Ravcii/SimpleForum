<?php

class template{
	private static $_instance;
    private function __construct(){}
	private function __clone(){}
	
    public static function getInstance() {
        if ( is_null(self::$_instance) ) {
            self::$_instance = new self();
        }
        return self::$_instance;
    }
	
	private $title = "qb Studio";
	private $template = null;

    public function addFile($file){
		$file = "./tpl/".$file;
		$handle = fopen($file, "r");
		$this->template .= fread($handle, filesize($file));
		fclose($handle);
	}
	
	public function setTitle($title){
		$this->title = $title;
	}
	
	public function replaceFile($str, $file){
		$file = "./tpl/".$file;
		$handle = fopen($file, "r");
		$text = fread($handle, filesize($file));
		fclose($handle);
		
		$this->template = str_replace($str, $text, $this->template);
	}
	
	public function addTitle($title){
		$this->title = $title . " » " . $this->title;
	}

    public function parse(){
		global $order, $user;
		
		//Строковые реплейсеры
		$this->template = str_replace("{header_title}", $this->title, $this->template);
		$this->template = str_replace("{isAdmin}", "<?=if( $user->isAdmin() ) { ?>", $this->template);
		$this->template = str_replace("{end}", "<?= } ?>", $this->template);
		
		//Файловые репллейсеры
		$this->replaceFile("{user_block}", "user-panel.php");
		
		//Another preg Replace's
		//Я не помню для чего, пока оставим
		//$this->template = preg_replace("#\\{user\\[(.*?)\\]\\}#ies", "\$_SESSION['\\1']", $this->template);
	}

    public function getTemplate(){
		return $this->template;
	}
}