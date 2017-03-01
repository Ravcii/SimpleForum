<?php
require_once("./engine/engine.php");
require_once("./engine/pages.php");

$template->parse();

echo $template->getTemplate();

if($db->getErrors()) {
	echo $db->getErrors();
}

echo "<!-- Written by Ravcii, 2013 -->";