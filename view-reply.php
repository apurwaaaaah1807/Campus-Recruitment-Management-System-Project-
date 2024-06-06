<?php session_start()?>
<!DOCTYPE html>
<html>
<head>
  <title>Company</title>
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
  background-color: orange;
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

<?php include_once "company-sidebar.php"?>

<div class="main">
  <h2>Welcome company - <?=$_SESSION["name"]?></h2>

<?php
  include "config.php";
  $rs = pg_query($con, "select application.id, apply_date, jid, sid, student_name, reply_date, reply_message from application, student where application.sid = student.id and jid in (select id from vacancy where company_id=".$_SESSION['uid'].") order by application.id");
  $n = pg_num_rows($rs);
  if($n>0){
?>
<table>
  <tr>
    <th>Application ID</th>
    <th>Application Date</th>
    <th>Job ID</th>
    <th>Student ID</th>
    <th>Student Name</th>
    <th>Reply Date</th>
    <th>Reply Message</th>
    <th colspan="4">Action</th>
  </tr>
<?php
  while($row = pg_fetch_row($rs)){
?>
  <tr>
    <td><?=$row[0]?></td>
    <td><?=$row[1]?></td>
    <td><?=$row[2]?></td>
    <td><?=$row[3]?></td>
    <td><?=$row[4]?></td>
    <td><?=is_null($row[5])?"Pending":$row[5]?></td>
    <td><?=is_null($row[6])?"Pending":$row[6]?></td>
    <td><a href="view-student-details.php?id=<?=$row[3]?>">Student Details</a></td>
    <td><a href="reply.php?id=<?=$row[0]?>&st=0">Reject</a></td>
    <td><a href="reply.php?id=<?=$row[0]?>&st=1">Accept</a></td>
    <td><a href="reply.php?id=<?=$row[0]?>&st=2">Placed</a></td>
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
