<h1>Login</h1>
<?php

if ($_SESSION["login-error"]) {
  $_SESSION["login-error"] = false;
  unset($_SESSION["login-error"]);
  echo "Login Error";
}

?>
<form action="" method="post" onsubmit="return true;">
  <input name="username" type="text">
  <input name="password" type="password">
  <button type="submit" name="login">submit</button>
</form>
