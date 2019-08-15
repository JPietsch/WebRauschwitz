<?php

require_once 'config.php';
require_once BACKEND . '/constructor.php';
require_once BACKEND . '/dbConnect.php';
require_once BACKEND . '/login.php';

$_constr = Constructor::getInstance();
$_constr->view = "view";

if (@$_GET[0] == "admin") {
	/*if (!$login->checkLogin()){
		$_constr->view = "login";
	}else {*/
		$_constr->view = "admin";
  #}
}

$_constr->build();

?>
