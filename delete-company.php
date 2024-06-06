<?php
	include "config.php";
  pg_query($con, "delete from company where id=".$_GET["id"]);
  header("Location: verify-company.php");
?>
