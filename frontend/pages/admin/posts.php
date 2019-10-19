<h1>Posts</h1>

<?php

$db = dbConnect::getConnection();

$stmt = $db->prepare("SELECT * FROM posts");
$test = $stmt->execute();
$res = $stmt->fetchAll(PDO::FETCH_ASSOC);

$post = new post;
$post->checkPost();

if (isset($_POST["delete"])) {
  $post->deletePost($_POST["id"]);
}

foreach ($res as $post) {
  echo $post["title"]."<br>";
  echo "<form method=\"POST\"><input type=\"hidden\" name=\"id\" value=\"".$post["PID"]."\"><button type=\"submit\" name=\"delete\">delete</button></form><br><br>";
}

?>
