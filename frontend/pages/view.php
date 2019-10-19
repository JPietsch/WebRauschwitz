<?php

$items = [
  "Startseite"    => "/",
  "Bildergalerie" => "/bildergalerie",
  "Sportfest"     => "/sportfest",
  "Allgemeines"   => "/allgemeines",
  "Elstra"        => "https://www.elstra.de/"
];

ob_start();

foreach ($items as $name => $page) {
	?><li <?="/" . $_GET[0] == $page ? "class=\"active\"" : null ?>><a href="<?=$page?>"><?=$name?></a></li><?php
}

$nav = ob_get_clean();

?>

<nav>
  <ul>
    <?=$nav?>
  </ul>
</nav>
<main>
  <?php require_once FRONTEND . "/pages/views/" . "$constr->viewfile"; ?>
</main>
<footer>
  <?php include_once "views/footer.html" ?>
</footer>
