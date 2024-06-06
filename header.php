<style>
    .pannelplacement a span{
        color: #fff !important;
    }
    .active a span{
        color: #fff;
    }
    .pannelmedicine a span{
        color: #fff;
    }
</style>
<div class="back">
	<nav class="navbar navbar-inverse navbar-static-top" role="navigation">
		<ul class="nav navbar-nav">
			<li class="active">
				<a href="index.php"><span class="fa fa-home"></span> Home</a>
			</li>
			<li class="pannelplacement"> 
				<a data-toggle="dropdown" href="#"><span class="fa fa-user"></span> LOGIN</a>
				<ul class="dropdown-menu">
					<li><a href="admin-login.php">Admin</a></li>
					<li><a href="company-login.php">Company</a></li>
					<li><a href="student-login.php">Student</a></li>
				</ul>
			</li>
			<li class="pannelplacement"> <a data-toggle="dropdown" href="#"><span class="fa fa-user-circle-o"></span> REGISTER</a>
				<ul class="dropdown-menu">
					<li><a href="company-register.php">Company</a></li>
					<li><a href="student-register.php">Student</a></li>
				</ul>
			</li>
			<li class="pannelmedicine">
				<a href="aboutus.php"><span class=" fa fa-users"></span>ABOUT US</a>
			</li>
			<li class="pannelmedicine"> <a href="contactus.php"><span class="glyphicon glyphicon-earphone"></span> CONTACT US</a></li>
			</li>
		</ul>
	</nav>
</div>
