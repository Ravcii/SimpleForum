<?php

class Template{
	private $title = _TITLE_;
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
	
	public function getTextFromFile($file){
		$file = "./tpl/".$file;
		$handle = fopen($file, "r");
		$text = fread($handle, filesize($file));
		fclose($handle);
		
		return $text;
	}
	
	public function addTitle($title){
		$this->title = $title . " » " . $this->title;
	}

    public function parse(){
		global $user;
		
		//Строковые реплейсеры
		$this->template = str_replace("{header_title}", $this->title, $this->template);
		$this->template = str_replace("{isLogged}", "<?php if( $user->isLogged() ) { ?>", $this->template);
		$this->template = str_replace("{else}", "<?php } else { ?>", $this->template);
		$this->template = str_replace("{end}", "<?php } ?>", $this->template);
        
		$this->template = str_replace("{categories}", Categories::getCategoriesAsHtml(), $this->template);
        $this->template = str_replace("{load_messages}", Categories::getMessagesAsHtml(), $this->template);
        $this->template = str_replace("{messages_users}", Categories::getMessagesUsersAsHtml(), $this->template);
		//Файловые репллейсеры
		//Пусть лежит для примера. Удалите как не будет нужен
		//$this->replaceFile("{user_block}", "user-panel.php");
		
		//Another preg Replace's
		//Я не помню для чего, пока оставим
		//$this->template = preg_replace("#\\{user\\[(.*?)\\]\\}#ies", "\$_SESSION['\\1']", $this->template);
	}

    public function getTemplate(){
		return $this->template;
	}
}