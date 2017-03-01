<?php

//Base classes
require_once("config.php");

require_once("classes/template.class.php");
$template = template::getInstance();

require_once("classes/mysql.class.php");
$db = mysql::getInstance();
$db->connect(DBLOC, DBUSER, DBPASS, DBNAME);

require_once("session.php");

require_once("classes/user.class.php");
$user = new user();