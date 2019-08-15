<?php

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

  protected function __construct(){
    self::$_instance = $this;
  }

  public function build(){
    if ($_GET[0] == "admin"){
      switch ($_GET[1]) {

        default:
        case "dashboard":
          $this->headline = "Dashboard";
          $this->viewfile = "dashboard.html";
          break;

        case "posts":
          $this->headline = "Posts";
          $this->viewfile = "posts.html";
          break;

        case "email":
          $this->headline = "Email";
          $this->viewfile = "email.html";
          break;
      }
    }else {
      switch ($_GET[0]) {
        default:
          $this->headline = "Startseite";
          $this->viewfile = "start.html";
          break;

        case "allgemeines":
          $this->headline = "Allgemeines";
          $this->viewfile = "allgemeines.html";
          break;

        case "bildergalerie":
          $this->headline = "Bildergalerie";
          $this->viewfile = "bildergalerie.html";
          break;

        case "sportfest":
          $this->headline = "Sportfest";
          $this->viewfile = "sportfest.html";
          break;

        case "kontakt":
          $this->headline = "Kontakt";
          $this->viewfile = "kontakt.html";
          break;

        case "impressum":
          $this->headline = "Impressum";
          $this->viewfile = "impressum.html";
          break;
      }
    }

    switch ($this->view){
      case "view":
        $this->title	= $this->title ?? TITLE;
        $this->modfile	= frontend . "/pages/view.php";
        $this->cssfiles = array_merge();
        $this->jsfiles	= array_merge();
        break;

      case "login":
        $this->title	= $this->title ?? TITLE_ADMIN;
        $this->modfile	= frontend . "/pages/login.php";
        $this->cssfiles = array_merge();
        $this->jsfiles	= array_merge();
        break;

      case "admin":
        $this->title	= $this->title ?? TITLE_ADMIN;
        $this->modfile	= frontend . "/pages/admin.php";
        $this->cssfiles = array_merge();
        $this->jsfiles	= array_merge();
        break;

      default: return false;
    }

    include_once frontend . "/blueprint.php";
    return true;
  }

  static public function getInstance() {
    if (self::$_instance === null){
      self::$_instance = new Constructor();
    }
		return self::$_instance;
	}
}


?>
