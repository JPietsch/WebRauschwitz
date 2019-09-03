<?php

// ############################################################################
// INCLUDING ALL NECESSARY FILES
// ############################################################################

require_once 'config.php';
require_once BACKEND . '/constructor.php';
require_once BACKEND . '/dbConnect.php';
require_once BACKEND . '/login.php';

// ############################################################################
// CREATING A NEW INSTANCE OF THE CONSTRUCTOR
// ############################################################################

$_constr = Constructor::getInstance();
$_constr->view = "view";

// ############################################################################
// BUILDING THE WEBSITE WITH THE CONSTRUCTOR
// ############################################################################

$_constr->build();

?>
