<?php
	session_start();

	if(isset($_POST["submit"])){
		$email = $_POST["email"];
		$pass = $_POST["pass"];

		include "config.php";

	    $rs = pg_query($con, "select * from company where company_email='$email' and company_pwd='$pass' and is_active=1");

	    $row = pg_fetch_assoc($rs);

	    if($row){
	    	$_SESSION["uid"] = $row["id"];
	    	$_SESSION["name"] = $row["company_name"];
	    	echo "<script>alert('Company login successful');location.href='company-dashboard.php'</script>";
	    }
	    else{
	    	echo "<script>alert('Company login failed. Invalid email/password.');location.href='company-login.php'</script>";	    	
	    }
	}
?>

<!DOCTYPE html>
<html lang="en" dir="ltr">

	<head>
		<meta charset="utf-8">
		<title>Login Page</title>
		<link rel="stylesheet" href="css/Loginpage.css">
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" />
	</head>

	<body>
		<div class="bg-img">
			<div class="content">
				<div><img src="images/company-logo.jfif" style="border-radius: 50%;width: 100px; height: 100px;"></div>
				<header>Company Login</header>
				<form method="post">
					<div class="field">
						<span class="fa fa-user"></span>
						<input type="email" name="email" required placeholder="Email">
					</div>
					<div class="field space">
						<span class="fa fa-lock"></span>
						<input type="password" class="pass-key" name="pass" required placeholder="Password">
						<span class="show">SHOW</span>
					</div>
					<div class="field space">
						<input type="submit" value="LOGIN" name="submit">
					</div>
				</form>

				<div class="signup space">
					Don't have account?
					<a href="company-register.php">Signup Now</a>
				</div>
			</div>
		</div>
	<script>
		const pass_field = document.querySelector('.pass-key');
const showBtn = document.querySelector('.show');
showBtn.addEventListener('click', function () {
	if (pass_field.type === "password") {
		pass_field.type = "text";
		showBtn.textContent = "HIDE";
		showBtn.style.color = "#3498db";
	} else {
		pass_field.type = "password";
		showBtn.textContent = "SHOW";
		showBtn.style.color = "#222";
	}
});
	</script>
	</body>
</html>



