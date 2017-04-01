<?php

class Template {
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
    
    public function replaceString($find, $replace){
        $this->template = str_replace($find, $replace, $this->template);
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
    
    public function getTitle(){
        return $this->title;
    }

    public function getTemplate(){
		return $this->template;
	}
}