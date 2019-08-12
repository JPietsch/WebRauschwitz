<?php

# Zeitzone und -format
date_default_timezone_set("Europe/Berlin");
define('DATETIME', 'Y-m-d H:i:s');

/* # Session
session_name("__SessID");
session_start(); */

# Verzeichnisse
define("backend",	__DIR__ . "/../backend");
define("css", __DIR__ . "/assets/css");
define("img", __DIR__ . "/assets/img");
define("js", __DIR__ . "/assets/js");

?>
