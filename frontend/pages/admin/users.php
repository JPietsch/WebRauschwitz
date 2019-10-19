<h1>Users</h1>

<?php

$db = dbConnect::getConnection();

$stmt = $db->prepare("SELECT * FROM users");
$test = $stmt->execute();
$res = $stmt->fetchAll(PDO::FETCH_ASSOC);

foreach ($res as $user) {
  echo $user["username"]."<br>";
  echo $user["password"]."<br><br>";
}

?>
