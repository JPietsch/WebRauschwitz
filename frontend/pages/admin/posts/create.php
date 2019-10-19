<?php

if (isset($_POST["publish"])) {
  $post = new post();
  $post->createNew($_SESSION["name"], $_POST["p_title"], $_POST["p_date"], $_POST["p_content"]);
  $post->sqlInsertPost();
}

?>

<form method="POST">
  <label for="">Title</label>
	<input type="text" name="p_title" id="title" />

  <label for="">Date</label>
	<input type="date" name="p_date" id="title" />

	<label for="">Content</label>
	<textarea name="p_content" id="title" cols="30" rows="10"></textarea>

  <button type="submit" name="publish">publish</button>
</form>
