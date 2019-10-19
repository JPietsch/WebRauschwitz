<?php

if (isset($_POST["create"])) {
  $post = new users();
  $post->createNew($_POST["u_user"], $_POST["u_name"], $_POST["u_email"],
    $_POST["u_pass"], $_POST["u_admin"]);
  $post->sqlInsertUser();
}


?>

<form method="POST">
  <label for="">Username</label>
	<input type="text" name="u_user" id="title" />

  <label for="">Name</label>
	<input type="text" name="u_name" id="title" />

  <label for="">E-Mail</label>
	<input type="text" name="u_email" id="title" />

  <label for="">Password</label>
	<input type="password" name="u_pass" id="title" />

  <label for="">Admin</label>
	<input type="checkbox" name="u_admin" id="title" />

  <button type="submit" name="create">create</button>
</form>
