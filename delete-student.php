<?php
	include "config.php";
  pg_query($con, "delete from student where id=".$_GET["id"]);
  header("Location: verify-student.php");
?>
