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
  margin-left: 160px; /* Same as the width of the sidenav */
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
  background-color: orange;
}

a{
  text-decoration: none;
  padding: 10px;
  border-radius: 5px;
  color: blue;
}
.main{
  margin:0 0 0 250px;
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
  $year = $_POST['year'];
  $month = $_POST['month'];

  $rs = pg_query($con, "select * from student where EXTRACT('Year' FROM student_regdate) = $year and EXTRACT('Month' FROM student_regdate) = $month order by id");

  $n = pg_num_rows($rs);
  if($n>0){
?>
<table>
  <tr>
    <th>ID</th>
    <th></th>
    <th>Name</th>
    <th>Gender</th>
    <th>Address</th>
    <th>Phone</th>
    <th>Email</th>
    <th>DOB</th>
    <th>Reg Date</th>
    <th>Status</th>
    <th colspan="3">Action</th>
  </tr>
<?php
  while($row = pg_fetch_assoc($rs)){
?>
  <tr>
    <td><?=$row['id']?></td>
    <td><img src="student-photo/<?=$row['id']?>.jpg" width="150" height="100"></td>
    <td><?=$row['student_name']?></td>
    <td><?=$row['student_gender']?></td>
    <td><?=$row['student_address']?></td>
    <td><?=$row['student_phone']?></td>
    <td><?=$row['student_email']?></td>
    <td><?=$row['student_dob']?></td>
    <td><?=$row['student_regdate']?></td>
    <td><?=$row['is_active']==0?'Inactive':'Active'?></td>
    <td><a href="delete-student.php?id=<?=$row['id']?>" onclick="return confirm('Delete student?')">Delete</a></td>
    <td><a href="view-education.php?id=<?=$row['id']?>">View Education</a></td>
    <td><a href="change-student-status.php?id=<?=$row['id']?>&st=<?=$row['is_active']?>"><?=$row['is_active']==0?'Activate':'Deactivate'?></a></td>
  </tr>
<?php
  }
?>
</table>
<?php
}
else{
?>
<h3>No data found.</h3>
<?php
  }
?>
</div>
   
</body>
</html> 
