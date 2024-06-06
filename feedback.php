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
  $rs = pg_query($con, "select * from contact order by id");
  $n = pg_num_rows($rs);
  if($n>0){
?>
<table>
  <tr>
    <th>ID</th>
    <th>Name</th>
    <th>Email</th>
    <th>Message</th>
    <th>Action</th>
  </tr>
<?php
  while($row = pg_fetch_assoc($rs)){
?>
  <tr>
    <td><?=$row['id']?></td>
    <td><?=$row['name']?></td>
    <td><?=$row['email']?></td>
    <td><?=$row['message']?></td>
    <td><a href="delete-feedback.php?id=<?=$row['id']?>" onclick="return confirm('Delete student?')">Delete</a></td>
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
