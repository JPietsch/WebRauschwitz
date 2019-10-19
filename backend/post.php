<?php

// ############################################################################
// POST CLASS -
// ############################################################################

class post {

  private static $date;
  private static $title;
  private static $author;
  private static $content;
  private static $published;
  private static $db;

  public function __construct($json = false) {
    self::$db = dbConnect::getConnection($json);
  }

  public function checkPost() {

    $stmt = self::$db->prepare("SELECT PID, date FROM posts");
    $stmt->execute();
    $res = $stmt->fetchAll(PDO::FETCH_ASSOC);

    foreach ($res as $post) {
      if ($post["date"] < date(DATE)) {
        $this->deletePost($post["PID"]);
      }
    }

  }

  public function createNew($author, $title, $date, $content) {
    $this->setParams(date(DATE), $author, $title, $date, $content);
  }

  private function setParams($published, $author, $title, $date, $content) {
    $this->published = $published;
    $this->author = $author;
    $this->title = $title;
    $this->date = $date;
    $this->content = $content;
  }

  public function sqlInsertPost() {

    if (!is_null($this->title) || !is_null($this->content)) {

      $stmt = self::$db->prepare("INSERT INTO posts
        (title, author, published, date, content) VALUES (:ti, :a, :to, :d, :c)");
      $stmt->bindParam(":ti", $this->title);
      $stmt->bindParam(":a", $this->author);
      $stmt->bindParam(":to", $this->published);
      $stmt->bindParam(":d", $this->date);
      $stmt->bindParam(":c", $this->content);

      $stmt->execute();

      $this->updateTable();

      header("Location: https://env.rauschwitz-online.de/admin/posts");
      die();

    }

  }

  public function deletePost($id) {

    $stmt = self::$db->prepare("DELETE FROM posts WHERE PID=:id");
    $stmt->bindParam(":id", $id);
    $stmt->execute();

    $this->updateTable();

    header("Location: https://env.rauschwitz-online.de/admin/posts");
    #die();

  }

  private function updateTable() {

    $stmt = self::$db->prepare("ALTER TABLE posts DROP PID");
    $stmt->execute();

    $stmt = self::$db->prepare("ALTER TABLE posts ADD
      PID INT(10) NOT NULL AUTO_INCREMENT FIRST, ADD PRIMARY KEY (PID)");
    $stmt->execute();

  }

}

?>
