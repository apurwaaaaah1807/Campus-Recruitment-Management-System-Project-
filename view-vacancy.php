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
  width: 200px;
  position: fixed;
  z-index: 1;
  top: 0;
  left: 0;
  background-color: #111;
  overflow-x: hidden;
  padding-top: 18px;
}

.sidenav a {
  padding: 6px 8px 6px 16px;
  text-decoration: none;
  font-size: 20px;
  color: #818181;
  display: block;
}

.sidenav a:hover {
  color: #f1f1f1;
}

.main {
  margin-left: 200px; /* Same as the width of the sidenav */
  font-size: 20px; /* Increased text to enable scrolling */
  padding: 0px 10px;
}

@media screen and (max-height: 450px) {
  .sidenav {padding-top: 15px;}
  .sidenav a {font-size: 18px;}
}

input{
  padding: 10px;
  font-size: 15px;
}

input[type=submit], input[type=reset]{
  background-color: black;
  border-radius: 5px;
  color: white;
}
td,th{
  padding: 5px;
  font-size: 15px;
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
  width:70% !important;
  margin:0 0 0 260px;
}
</style>
</head>
<body>

<?php include_once "admin-sidebar.php"?>

<?php
include "config.php";
?>
<div class="main">
  <h2>Welcome Admin - <?=$_SESSION["name"]?></h2>
    <table>
      <tr>
        <th>ID</th>
        <th>Job Title</th>
        <th>Job Description</th>
        <th>No.of Openings</th>
        <th>Job Location</th>
        <th>Monthly Salary</th>
        <th>Post Date</th>
        <th>Last Date</th>
        <th>Status</th>
        <th>Action</th>
      </tr>
<?php
  $rs = pg_query($con, "select * from vacancy where company_id=".$_GET['id']." order by id");
      while($row = pg_fetch_assoc($rs)){
?>
    <tr>
      <td><?=$row['id']?></td>
      <td><?=$row['job_title']?></td>
      <td><?=$row['job_description']?></td>
      <td><?=$row['no_of_openings']?></td>
      <td><?=$row['job_location']?></td>
      <td><?=$row['monthly_salary']?></td>
      <td><?=$row['post_date']?></td>
      <td><?=$row['last_date']?></td>
      <td><?=$row['is_valid']==1?'Visible':'Pending'?></td>
      <td><a href="change-vacancy-status.php?id=<?=$row['id']?>&st=<?=$row['is_valid']?>&cid=<?=$row['company_id']?>"><?=$row['is_valid']==0?'Activate':'Deactivate'?></a></td>
    </tr>
<?php
      }
?>
  </table>
</div>
   
</body>
</html> 
