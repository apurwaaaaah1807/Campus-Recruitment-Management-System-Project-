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
  $rs = pg_query($con, "select * from company where EXTRACT('Year' FROM company_regdate) = $year order by id");
  $n = pg_num_rows($rs);
  if($n>0){
?>
<table>
  <tr>
    <th>ID</th>
    <th></th>
    <th>Company Name</th>
    <th>Contact Person</th>
    <th>Address</th>
    <th>Phone</th>
    <th>Email</th>
    <th>Website</th>
    <th>Reg Date</th>
    <th>Status</th>
    <th colspan="3">Action</th>
  </tr>
<?php
  while($row = pg_fetch_assoc($rs)){
?>
  <tr>
    <td><?=$row['id']?></td>
    <td><img src="company-logo/<?=$row['id']?>.jpg" width="150" height="100"></td>
    <td><?=$row['company_name']?></td>
    <td><?=$row['contact_person']?></td>
    <td><?=$row['company_address']?></td>
    <td><?=$row['company_phone']?></td>
    <td><?=$row['company_email']?></td>
    <td><a href="<?=$row['company_url']?>"><?=$row['company_url']?></a></td>
    <td><?=$row['company_regdate']?></td>
    <td><?=$row['is_active']==0?'Inactive':'Active'?></td>
    <td><a href="delete-company.php?id=<?=$row['id']?>" onclick="return confirm('Delete company?')">Delete</a></td>
    <td><a href="view-vacancy.php?id=<?=$row['id']?>">View Vacancy</a></td>
    <td><a href="change-company-status.php?id=<?=$row['id']?>&st=<?=$row['is_active']?>"><?=$row['is_active']==0?'Activate':'Deactivate'?></a></td>
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
