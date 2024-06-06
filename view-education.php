<?php session_start()?>
<!DOCTYPE html>
<html>
<head>
  <title>Admin</title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<style>
body {
  font-family: "Lato", sans-serif;
}

.sidenav {
  height: 100%;
  width: 160px;
  position: fixed;
  z-index: 1;
  top: 0;
  left: 0;
  background-color: #111;
  overflow-x: hidden;
  padding-top: 20px;
}

.sidenav a {
  padding: 6px 8px 6px 16px;
  text-decoration: none;
  font-size: 18px;
  color: #818181;
  display: block;
}

.sidenav a:hover {
  color: #f1f1f1;
}

.main {
  margin-left: 250px; /* Same as the width of the sidenav */
  font-size: 20px; /* Increased text to enable scrolling */
  padding: 0px 10px;
}

table{
  font-size: 15px;
}

td, th{
  border: 1px solid black;
  padding: 10px;
}

th{
  background-color: white;
}

a{
  text-decoration: none;
  padding: 10px;
  border-radius: 5px;
  color: blue;
}
@media screen and (max-height: 450px) {
  .sidenav {padding-top: 15px;}
  .sidenav a {font-size: 18px;}
}
</style>
</head>
<body>

<?php include_once "admin-sidebar.php"?>

<div class="main">
  <h2>Welcome Admin - <?=$_SESSION["name"]?></h2>

<?php
  include "config.php";
  $rs = pg_query($con, "select * from student where id=".$_GET["id"]);
  $row = pg_fetch_assoc($rs);
?>

    <table border="">
    <tr>
      <th></th>
      <th>Board</th>
      <th>Year of Passing</th>
      <th>Percentage</th>
      <th>CGPA</th>
    </tr>
    <tr>
      <th>SSC</th>
      <th><?=$row['ssc_board']?></th>
      <th><?=$row['ssc_yop']?></th>
      <th><?=$row['ssc_per']?></th>
      <th><?=$row['ssc_cgpa']?></th>
    </tr>
    <tr>
      <th>HSC</th>
      <th><?=$row['hsc_board']?></th>
      <th><?=$row['hsc_yop']?></th>
      <th><?=$row['hsc_per']?></th>
      <th><?=$row['hsc_cgpa']?></th>
    </tr>
    <tr>
      <th>Graduation</th>
      <th><?=$row['ug_board']?></th>
      <th><?=$row['ug_yop']?></th>
      <th><?=$row['ug_per']?></th>
      <th><?=$row['ug_cgpa']?></th>
    </tr>
    <tr>
      <th>Post Graduation</th>
      <th><?=$row['pg_board']?></th>
      <th><?=$row['pg_yop']?></th>
      <th><?=$row['pg_per']?></th>
      <th><?=$row['pg_cgpa']?></th>
    </tr>
    <tr>
      <th>Extra Curricular:</th>
      <th colspan="4"><?=$row['extra_curriculars']?></th>
    </tr>
    <tr>
      <th>Other Achievements:</th>
      <th colspan="4"><?=$row['other_achivement']?></th>
    </tr>
  </table>
</div>
</body>
</html> 
