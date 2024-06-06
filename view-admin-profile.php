<?php session_start()?>

<?php
  include "config.php";
  $rs = pg_query($con, "select * from admin where id=".$_SESSION["uid"]);
  $row = pg_fetch_assoc($rs);

  if(isset($_POST["submit"])){
    $id = $_POST["id"];
    $pass = $_POST["pass"];
    pg_query($con, "update admin set admin_pwd='$pass' where id=$id");
    echo "<script>alert('Password updated successfully');location.href='admin-dashboard.php';</script>";
  }
?>

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

@media screen and (max-height: 450px) {
  .sidenav {padding-top: 15px;}
  .sidenav a {font-size: 18px;}
}

input{
  padding: 10px;
  font-size: 15px;
}

input[type=submit]{
  background-color: black;
  border-radius: 5px;
  color: white;
}
td,th{
  padding: 5px;
}
</style>
</head>
<body>

<?php include_once "admin-sidebar.php"?>

<div class="main">
  <h2>Welcome Admin - <?=$_SESSION["name"]?></h2>

  <form method="post">
  <table>
    <tr>
      <td><b>ID</b></td>
      <td><input type="text" name="id" value="<?=$row['id']?>" readOnly></td>
    </tr>
    <tr>
      <td><b>Name</b></td>
      <td><input type="text" name="name" value="<?=$row['admin_name']?>" readOnly></td>
    </tr>
    <tr>
      <td><b>Email</b></td>
      <td><input type="email" name="email" value="<?=$row['admin_email']?>" readOnly></td>
    </tr>
    <tr>
      <td><b>Password</b></td>
      <td><input type="text" name="pass" value="<?=$row['admin_pwd']?>" required></td>
    </tr>
    <tr>
      <td colspan="2" align="center"><input type="submit" name="submit" value="Change Password"></td>
    </tr>
  </table>  
  </form>
</div>
   
</body>
</html> 
