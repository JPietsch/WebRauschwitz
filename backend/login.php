<?php

// ############################################################################
// LOGIN CLASS - TO HANDLE LOGIN, SESSIONS AND LOGOUT
// ############################################################################

class login {

  private static $db;

  public function __construct($json = false) {
    self::$db = dbConnect::getConnection($json);
  }

  public function checkLogin() {

    if (isset($_POST["logout"])) {
      $this->logout();
      return false;
    }

    $error = null;
		$_SESSION["from"] = $_SERVER["REQUEST_URI"];

    if (isset($_SESSION["UID"])) {
			if ($this->validateSession()) {
				$this->getUserData();
				return true;
			}
		}

    if (isset($_POST["login"])) {
      if (empty($_POST["password"]) || empty($_POST["username"])) {
        # error handling
			}
      if ($error !== null) {
				$_SESSION["login-error"] = true;
				return false;
			}
      if ($this->login($_POST["username"], $_POST["password"])) {
				$this->getUserData();
				header('Refresh: 0');
				return true;
			}
    }

    return false;

  }

  protected function login($username, $password) {

    if (is_null(trim($username)) || is_null(trim($password))) {
      return false;
    }

    $stmt = self::$db->prepare("SELECT UID, password FROM users
      WHERE username=:u");
		$stmt->bindParam(":u", $username);

    $stmt->execute();
    $res = $stmt->fetch(PDO::FETCH_ASSOC);

    if (password_verify($password, $res["password"]) && $stmt->rowCount() == 1) {

      $_SESSION["UID"] = $res["UID"];

      $session_id = session_id();

      $stmt = self::$db->prepare("UPDATE users SET session=:s
        WHERE UID=:uid AND username=:u");
			$stmt->bindParam(":s", $session_id);
			$stmt->bindParam(":uid", $_SESSION["UID"]);
			$stmt->bindParam(":u", $username);

      if ($stmt->execute() && $stmt->rowCount() == 1) {
        $this->getUserData();
        header("Location: " . $_SESSION["from"]);
        die();
      }

    }

    $_SESSION["login-error"] = true;
    return false;

  }

  private function logout() {

		$session_id = session_id();

		$stmt = self::$db->prepare("UPDATE users SET session=null
      WHERE session=:s");
		$stmt->bindParam(":s", $session_id);
		$stmt->execute();
		$this->clearLogin();

		header("Location: " . $_SERVER["REQUEST_URI"]);
		die();

	}


	public function clearLogin() {

		$_SESSION = [];
		unset($_SESSION);
		session_reset();

	}

  private function validateSession() {

    $session_id = session_id();

		$stmt = self::$db->prepare("SELECT UID FROM users
      WHERE username=:u AND session=:s");
		$stmt->bindParam(":u", $_SESSION["username"]);
		$stmt->bindParam(":s", $session_id);

		if ($stmt->execute() && $stmt->rowCount() == 1) {
			$gatheredUID = $stmt->fetch(PDO::FETCH_COLUMN);
			if ($gatheredUID == $_SESSION["UID"]) {
				return true;
      }
		}

		return false;

  }

  private function getUserData() {

    $session_id = session_id();

    $stmt = self::$db->prepare("SELECT username, name, email, admin FROM users
      WHERE UID=:u AND session=:s");
		$stmt->bindParam(":u", $_SESSION["UID"]);
		$stmt->bindParam(":s", $session_id);

    if ($stmt->execute() && $stmt->rowCount() == 1) {
      $res = $stmt->fetch(PDO::FETCH_ASSOC);
      foreach ($res as $key=>$value) {
        $_SESSION[$key] = $value;
      }
    }

  }

}

?>
