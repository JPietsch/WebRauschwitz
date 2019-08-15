<?php

# Zeitzone und -format
date_default_timezone_set("Europe/Berlin");
define('DATETIME', 'Y-m-d H:i:s');

# Titel
define('TITLE', 'Webseite Rauschwitz');
define('TITLE_ADMIN', 'Admin');

/* # Session
session_name("__SessID");
session_start(); */

# Verzeichnisse
define('backend',	__DIR__ . '/../backend');
define('frontend',	__DIR__ . '/../frontend');

?>
