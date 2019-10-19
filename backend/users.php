<?php

// ############################################################################
// USERS CLASS -
// ############################################################################

class users {

  private static $user;
  private static $name;
  private static $eamil;
  private static $pass;
  private static $admin;
  private static $db;

  public function __construct($json = false) {
    self::$db = dbConnect::getConnection($json);
  }

  public function createNew($user, $name, $email, $password, $admin) {
    $admin = ($admin == "on") ? 1 : 0;
    $pass = password_hash($password, PASSWORD_DEFAULT);
    $this->setParams($user, $name, $email, $pass, $admin);
  }

  private function setParams($user, $name, $email, $pass, $admin) {
    $this->user = $user;
    $this->name = $name;
    $this->email = $email;
    $this->pass = $pass;
    $this->admin = $admin;
  }

  public function sqlInsertUser() {

    if (!is_null($this->user) || !is_null($this->pass) || !is_null($this->admin)) {

      $stmt = self::$db->prepare("INSERT INTO users
        (username, name, email, password, admin) VALUES (:u, :n, :e, :p, :a)");
      $stmt->bindParam(":u", $this->user);
      $stmt->bindParam(":n", $this->name);
      $stmt->bindParam(":e", $this->email);
      $stmt->bindParam(":p", $this->pass);
      $stmt->bindParam(":a", $this->admin);

      $stmt->execute();

      header("Location: https://env.rauschwitz-online.de/admin/users");
      die();

    }

  }

}

?>
