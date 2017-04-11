<?php

error_reporting(E^ALL);
ob_start();

require_once("./engine/engine.php");
require_once("./engine/pages.php");

//Оставим, как память о мега-костыле.
//echo $template->getTemplate();
eval(' ?>'.$template->getTemplate());

ob_end_flush();