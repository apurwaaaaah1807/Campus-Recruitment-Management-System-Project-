<?php
	if(isset($_POST["submit"])){
		$name = $_POST["name"];
		$email = $_POST["email"];
		$msg = $_POST["msg"];

		include "config.php";

	    pg_query($con, "insert into contact(name, email, message) values('$name', '$email', '$msg')");
	    echo "<script>alert('Thank you for contacting us.');location.href='index.php'</script>";
	}
?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
	<head>
		<title>Contact Us</title>
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">

		<link rel="stylesheet" href="css/contactus.css">
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.2/css/all.min.css"/>
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
		<link rel="stylesheet" type="text/css" href="css/Contactus.css">
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

		<style>
			body{
				display: flex;
				flex-direction: column;
				min-height: 0px !important;
			}
			.back{
				width:100%;
			}
		</style>
	</head>
	<body>
			<?php
			   include_once "header.php";
			?>
		<div class="container">
			<div class="content">
				<div class="left-side">
					<div class="address details">
						<i class="fas fa-map-marker-alt"></i>
						<div class="topic">Address</div>
						<div class="text-one">CRMS 1218</div>
						<div class="text-two">Chinchwad Pune</div>
					</div>
					<div class="phone details">
						<i class="fas fa-phone-alt"></i>
						<div class="topic">Phone</div>
						<div class="text-one">+91 70286 58580</div>
						<div class="text-two">+91 78418 23288</div>
					</div>

					<div class="email details">
						<i class="fas fa-envelope"></i>
						<div class="topic">Email</div>
						<div class="text-one">CRMS@gmail.com</div>
						<div class="text-two">info.CRMS@gmail.com</div>
					</div>
				</div>
				<div class="right-side">
					<div class="topic-text">Send us a message</div>
					<p>If you have any work from me or any types of quries related to my tutorial, you can send me message from here. It's my pleasure to help you.</p>
					<form method="post">
						<div class="input-box">
							<input type="text" name="name" placeholder="Enter your name" style="color: black;" required>
						</div>
						<div class="input-box">
							<input type="email" name="email" placeholder="Enter your email" style="color: black;" required>
						</div>
						<div class="input-box message-box">
							<textarea placeholder="Enter your message" name="msg" required style="color: black;"></textarea>	
						</div>
						<div class="button">
							<input type="submit" value="Send Now" name="submit">
						</div>
					</form>
				</div>
			</div>
		</div>
	</body>
</html>


