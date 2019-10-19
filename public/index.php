<?php

// ############################################################################
// INCLUDING ALL NECESSARY FILES
// ############################################################################

require_once 'config.php';
require_once BACKEND . '/constructor.php';
require_once BACKEND . '/dbConnect.php';
require_once BACKEND . '/login.php';
require_once BACKEND . '/post.php';
require_once BACKEND . '/users.php';

// ############################################################################
// CREATING A NEW INSTANCE OF THE CONSTRUCTOR
// ############################################################################

$_constr = Constructor::getInstance();
$_constr->view = "view";

if ($_GET[0] == "admin") {

  try {
    $login = new login();
  } catch (Exception $e) {
    die("<h1>500 Internal Server Error<br></h1>" . $e->getMessage());
  }

  if (!$login->checkLogin()) {
    $_constr->view = "login";
  } else {
    $_constr->view = "admin";
  }

}

// ############################################################################
// BUILDING THE WEBSITE WITH THE CONSTRUCTOR
// ############################################################################

$_constr->build();

?>
