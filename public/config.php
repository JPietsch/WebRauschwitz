<?php

# Zeitzone und -format
date_default_timezone_set('Europe/Berlin');
define('DATETIME', 'Y-m-d H:i:s');

# Titel
define('TITLE', 'Webseite Rauschwitz');
define('TITLE_ADMIN', 'Admin');

# Datenbank
require_once 'secure/dbConfig.php';

/* # Session
session_name("__SessID");
session_start(); */

# Verzeichnisse
define('BACKEND',	__DIR__ . '/../backend');
define('FRONTEND',	__DIR__ . '/../frontend');

?>
