<?php

// ############################################################################
// BLUEPRINT - THIS FILE CREATS THE BASIC HTML-FRAMEWORK FOR ALL PAGES
// ############################################################################

$constr = Constructor::getInstance();

?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta name="theme-color" content="">
  <meta name="author" content="<?=AUTHOR?>">
  <meta name="keywords" content="<?=KEYWORDS?>">
  <meta name="description" content="<?=DESCRIPTION?>">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>
    <?=$constr->headline?$constr->headline . " - " : null?>
    <?=$constr->title?>
  </title>
  <?php

    // ########################################################################
    // CREATING A LINK-TAG FOR EACH STYLESHEET
    // ########################################################################

    if (!empty($constr->cssfiles)) {
    	foreach ($constr->cssfiles as $cssfile) {
    		echo "\t<link rel=\"stylesheet\"
          href=\"/styles/css/" . $cssfile . "\" />\r\n";
    	}
    }

    // ########################################################################
    // CREATING A SCRIPT-TAG FOR EACH JAVASCRIPT
    // ########################################################################

    if (!empty($constr->jsfiles)) {
    	foreach ($constr->jsfiles as $jsfile) {
    		echo "\t<script type=\"text/javascript\"
          src=\"/js/" . $jsfile . "\"></script>\r\n";
    	}
    }

  ?>
</head>
<body>
  <div id="wrapper">
    <?php
      $login = new login();
      if ($login->checkLogin()) {
        include_once "pages/header.html";
      }
      require_once "$constr->modfile";
    ?>
  </div>
</body>
</html>
