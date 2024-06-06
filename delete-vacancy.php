<?php
	include "config.php";
  pg_query($con, "delete from vacancy where id=".$_GET["id"]);
  header("Location: post-vacancy.php");
?>
