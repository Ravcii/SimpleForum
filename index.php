<?php

if($_SERVER["REMOTE_ADDR"] != "95.83.90.205") die();

require_once("./engine/engine.php");

require_once("./engine/pages.php");

$template->parse();

echo $template->getTemplate();

if($db->getErrors()) {
	echo $db->getErrors();
}

echo "<!-- Writed by Ravcii, 2013 -->";