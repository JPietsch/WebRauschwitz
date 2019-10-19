<h1>Startseite</h1>

<?php

$db = dbConnect::getConnection();

$post = new post;
$post->checkPost();

$stmt = $db->prepare("SELECT * FROM posts");
$test = $stmt->execute();
$res = $stmt->fetchAll(PDO::FETCH_ASSOC);

foreach ($res as $post) {
  echo $post["title"]."<br>";
  echo $post["content"]."<br><br>";
}


?>
