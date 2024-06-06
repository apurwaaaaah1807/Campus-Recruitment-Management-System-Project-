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

* {
  box-sizing: border-box;
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
  margin-left: 250px; /* Same as the width of the sidenav */
  font-size: 20px; /* Increased text to enable scrolling */
  padding: 0px 10px;
}

@media screen and (max-height: 750px) {
  .sidenav {padding-top: 15px;}
  .sidenav a {font-size: 18px;}
}

input[type=text], input[type=password], input[type=email], input[type=file], input[type=url] {
  width: 100%;
  padding: 15px;
  margin: 5px 0 22px 0;
  display: inline-block;
  border: none;
  background: #f1f1f1;
}

input[type=text]:focus, input[type=password]:focus, input[type=email], input[type=file], input[type=url] {
  background-color: #ddd;
  outline: none;
}

/* Overwrite default styles of hr */
hr {
  border: 1px solid #f1f1f1;
  margin-bottom: 25px;
}

/* Set a style for the submit button */
.registerbtn {
  background-color: #04AA6D;
  color: white;
  padding: 16px 20px;
  margin: 8px 0;
  border: none;
  cursor: pointer;
  width: 100%;
  opacity: 0.9;
}

.registerbtn:hover {
  opacity: 1;
}

/* Add a blue text color to links */
a {
  color: dodgerblue;
}

/* Set a grey background color and center the text of the "sign in" section */
.signin {
  background-color: #f1f1f1;
  text-align: center;
}

</style>
</head>
<body>

<?php include_once "company-sidebar.php"?>

<?php
  include "config.php";
  $rs = pg_query($con, "select * from company where id=".$_SESSION["uid"]);
  $row = pg_fetch_assoc($rs);

  if(isset($_POST["submit"]))
  {
    $id = $_POST["id"];
    $name = $_POST["name"];
    $cperson = $_POST["cperson"];
    $addr = $_POST["addr"];
    $phone = $_POST["phone"];
    $email = $_POST["email"];
    $url = $_POST["url"];
    $psw = $_POST["psw"];

    $result = pg_query($con, "select * from company where company_email='$email' and id<>$id") or die(pg_last_error());
    $row = pg_fetch_row($result);

    if($row)
    {
      echo "<script>alert('Company already registered.'); location.href='company-dashboard.php';</script>";
    }
    else
    {
      pg_query($con, "update company set company_name='$name', contact_person='$cperson', company_address='$addr', company_phone='$phone', company_email='$email', company_url='$url', company_pwd='$psw' where id=$id");

      if($_FILES["logo"]["tmp_name"]===""){
        $target_file = $id . ".jpg";
        move_uploaded_file($_FILES["logo"]["tmp_name"], "company-logo/".$target_file);    
      }
      echo "<script>alert('Company updated successfully.'); location.href='company-dashboard.php';</script>";
    }
  }
?>

<div class="main">
  <h2>Welcome Company - <?=$_SESSION["name"]?></h2>

<form method="post" enctype="multipart/form-data">
  <div class="container">
    <h3>Company Profile</h3>
    <hr>
    <label for="id"><b>Company ID</b></label>
    <input type="text" placeholder="Enter company name" name="id" id="id" value="<?=$row['id']?>" readOnly>
    <label for="name"><b>Company Name</b></label>
    <input type="text" placeholder="Enter company name" name="name" id="name" value="<?=$row['company_name']?>" required>
    <label for="cperson"><b>Contact Person</b></label>
    <input type="text" placeholder="Enter contact person name" name="cperson" id="cperson" value="<?=$row['contact_person']?>" required>
    <label for="addr"><b>Company Address</b></label>
    <input type="text" placeholder="Enter company address" name="addr" id="addr" value="<?=$row['company_address']?>" required>
    <label for="phone"><b>Company Phone</b></label>
    <input type="text" placeholder="Enter 10 digits company phone" name="phone" id="phone" pattern="^[6789]\d{9}$" value="<?=$row['company_phone']?>" required>
    <label for="email"><b>Company Email</b></label>
    <input type="email" placeholder="Enter company email" name="email" id="email" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,}$" value="<?=$row['company_email']?>" required>
    <label for="psw"><b>Company Website</b></label>
    <input type="url" placeholder="Enter company website" name="url" id="url" value="<?=$row['company_url']?>" required>
    <label for="psw"><b>Password</b></label>
    <input type="text" placeholder="Enter Password" name="psw" id="psw" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" title="Must contain at least one number and one uppercase and lowercase letter, and at least 8 or more characters" value="<?=$row['company_pwd']?>" required>
    <label for="logo"><b>Company Logo</b></label><br>
    <img src="company-logo/<?=$row['id']?>.jpg" width="150" height="100">
    <input type="file" name="logo" id="logo">
    <button type="submit" class="registerbtn" name="submit">Update</button>
    <button type="reset" class="registerbtn">Clear</button>
  </div>  
</form>

</div>
   
</body>
</html> 
