<?php
  session_start();

  if(!isset($_SESSION["uid"])){
    header("Location: index.php");
		return;
	}

  include "config.php";
  
  $result = pg_query($con, "select * from student");
  $nostu = pg_num_rows($result);

	$result = pg_query($con, "select * from company");
	$nocom = pg_num_rows($result);

	$result = pg_query($con, "select * from vacancy");
	$novac = pg_num_rows($result);

	$result = pg_query($con, "select * from contact");
	$nof = pg_num_rows($result);
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <title>Admin</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
  <style>
    /* Set height of the grid so .sidenav can be 100% (adjust as needed) */
    .row.content {height: 40px}
    .col-sm-8{
      margin:0 0 0 220px;
    }
    
    /* Set gray background color and 100% height */
    .sidenav {
      background-color: #f1f1f1;
      height: 100px;%;
    }
        
    /* On small screens, set height to 'auto' for the grid */
    @media screen and (max-width: 767px) {
      .row.content {height: auto;} 
    }

  </style>
</head>
<body>

<div class="container-fluid">
  <div class="row content">

	<?php include_once "admin-sidebar.php" ?>
  <div class="col-sm-8">
      <div class="well">
        <h4>Dashboard</h4>
        <p>Welcome <b><u><?=$_SESSION["name"]?></u></b></p>
      </div>
      <div class="row">
        <div class="col-sm-4">
          <div class="well">
            <h4>Total Student Registered</h4>
            <p><?=$nostu?></p> 
          </div>
        </div>
        <div class="col-sm-4">
          <div class="well">
            <h4>Total Company Registered</h4>
            <p><?=$nocom?></p> 
          </div>
        </div>
        <div class="col-sm-4">
          <div class="well">
            <h4>Total Vacancy</h4>
            <p><?=$novac?></p> 
          </div>
        </div>

        <div class="col-sm-4">
          <div class="well">
            <h4>Total Feedbacks</h4>
            <p><?=$nof?></p> 
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
</body>
</html>
