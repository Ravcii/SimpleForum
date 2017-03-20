<?php
require_once("./engine/engine.php");
require_once("./engine/pages.php");

$template->parse();

print $template->getTemplate();