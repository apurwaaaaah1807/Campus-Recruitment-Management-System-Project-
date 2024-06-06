<?php
	session_start();

	$_SESSION = array();
?>
<script type="text/javascript">
	alert("You are logged out successfully.");
	location.href = "index.php";
</script>