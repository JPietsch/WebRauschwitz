<?php

// ############################################################################
// CONSTRUCTOR CLASS - CREATES THE 'PAGE-VARIABLES' BASED ON THE URL
// ############################################################################

class Constructor {

  private static $_instance = null;
  public $error;
  public $view;
  public $title;
  public $headline;
  public $subs		          = [];
  public $modfile;
  public $viewfile	        = '.default';
  public $cssfiles          = [];
  public $jsfiles       	  = [];

  protected function __construct() {
    self::$_instance = $this;
  }

  public function build() {
    if ($_GET[0] == "admin") {
      switch ($_GET[1]) {

        default:
        case "dashboard":
          $this->headline = "Dashboard";
          $this->viewfile = "dashboard.php";
          break;

        case "posts":
          $this->headline = "Posts";
          $this->viewfile = "posts.php";

          if ($_GET[2] == "create"){
            $this->headline = "Create Post";
            $this->viewfile = "posts/create.php";
          }

          if ($_GET[2] == "edit"){
            $this->headline = "Edit Post";
            $this->viewfile = "posts/edit.php";
          }
          break;

        case "email":
          $this->headline = "Email";
          $this->viewfile = "email.php";
          break;

        case "users":
          $this->headline = "Users";
          $this->viewfile = "users.php";

          if ($_GET[2] == "create"){
            $this->headline = "Create User";
            $this->viewfile = "users/create.php";
          }

          if ($_GET[2] == "edit"){
            $this->headline = "Edit User";
            $this->viewfile = "users/edit.php";
          }
          break;
      }
    } else {
      switch ($_GET[0]) {
        default:
          # Erorr 404
          break;

        case "":
          $this->headline = "Startseite";
          $this->viewfile = "start.php";
          break;

        case "allgemeines":
          $this->headline = "Allgemeines";
          $this->viewfile = "allgemeines.php";
          break;

        case "bildergalerie":
          $this->headline = "Bildergalerie";
          $this->viewfile = "bildergalerie.php";
          break;

        case "sportfest":
          $this->headline = "Sportfest";
          $this->viewfile = "sportfest.php";
          break;

        case "kontakt":
          $this->headline = "Kontakt";
          $this->viewfile = "kontakt.php";
          break;

        case "impressum":
          $this->headline = "Impressum";
          $this->viewfile = "impressum.php";
          break;
      }
    }

    switch ($this->view) {
      case "view":
        $this->title	= $this->title ?? TITLE;
        $this->modfile	= FRONTEND . "/pages/view.php";
        $this->cssfiles = array_merge();
        $this->jsfiles	= array_merge();
        break;

      case "login":
        $this->title	= $this->title ?? TITLE_ADMIN;
        $this->modfile	= FRONTEND . "/pages/login.php";
        $this->cssfiles = array_merge();
        $this->jsfiles	= array_merge();
        break;

      case "admin":
        $this->title	= $this->title ?? TITLE_ADMIN;
        $this->modfile	= FRONTEND . "/pages/admin.php";
        $this->cssfiles = array_merge();
        $this->jsfiles	= array_merge();
        break;

      default: return false;
    }

    include_once FRONTEND . '/blueprint.php';
    return true;
  }

  static public function getInstance() {
    if (self::$_instance === null) {
      self::$_instance = new Constructor();
    }
		return self::$_instance;
	}
}


?>
