<?php
require_once("./engine/engine.php");
require_once("./engine/pages.php");

//Оставим, как память о мега-костыле.
//echo $template->getTemplate();
eval(' ?>'.$template->getTemplate());