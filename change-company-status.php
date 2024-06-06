<?php
	include "config.php";
  	$st = $_GET["st"]==0?1:0;
  	pg_query($con, "update company set is_active=$st where id=".$_GET["id"]);
  	header("Location: verify-company.php");
?>
