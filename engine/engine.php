<?php
//Base classes
require_once("config.php");

require_once("classes/template.class.php");
$template = new Template();

$db = new mysqli(DBLOC, DBUSER, DBPASS, DBNAME);
$db->set_charset("utf8");

require_once("session.php");

require_once("classes/user.class.php");
$user = new User();

require_once("classes/categories.class.php");
require_once("classes/topic.class.php");
//require_once("classes/sections.class.php");
//$sections = new Sections();
require_once("classes/topics.class.php");