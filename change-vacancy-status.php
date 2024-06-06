<?php
	include "config.php";
  $st = $_GET["st"]==0?1:0;
  pg_query($con, "update vacancy set is_valid=$st where id=".$_GET["id"]);
  header("Location: view-vacancy.php?id=".$_GET['cid']);
?>
