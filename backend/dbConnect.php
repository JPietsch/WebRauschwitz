<?php

// ############################################################################
// DBCONNECT CLASS - CONNETING TO THE DATABASE
// ############################################################################

# $db = dbConnect::getConnection($json);

class dbConnect {

  private static $db_host = DB_HOST;
	private static $db_name = DB_NAME;
	private static $db_user = DB_USER;
	private static $db_pass = DB_PASS;
	private static $_instance = null;
  private static $json;
  private static $db;

  protected function __construct($json) {

    self::$json = $json;

    try {

      self::$db = new PDO(
        "mysql:host=" . self::$db_host . ";dbname=" . self::$db_name,
        self::$db_user, self::$db_pass
      );
      self::$db->exec("SET NAMES UTF-8");

    } catch (PDOException $e) {

      error_reporting(0);
      header('HTTP/1.1 500 Internal Server Error', true, 500);
      $error = "Datenbank __construct() fehlgeschlagen.";
      if ($json) {
        header('Content-Type: application/json');
        die(json_encode(["error" => "$error", "error_code" => $e->getCode()]));
      }
      throw new Exception("$error");

    }

    self::$_instance = $this;
    return true;

  }

  static public function getInstance($json = false) {
		if (self::$_instance === null) {
			self::$_instance = new dbConnect($json);
		}
    return self::$_instance;
	}

	static public function getConnection($json = false) {
		self::getInstance($json);
		return self::getPdo();
	}

	protected static function getPdo() {
		if (is_null(self::$db)) {
			die("Datenbankverbindung unmöglich.");
		}
		return self::$db;
	}

}

?>
