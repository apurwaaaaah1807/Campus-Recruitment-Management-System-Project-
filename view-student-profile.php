<?php session_start()?>
<!DOCTYPE html>
<html>
<head>
  <title>Student</title>
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

@media screen and (max-height: 450px) {
  .sidenav {padding-top: 15px;}
  .sidenav a {font-size: 18px;}
}

input[type=text], input[type=password], input[type=email], input[type=file], input[type=url], input[type=date], select {
  width: 100%;
  padding: 15px;
  margin: 5px 0 22px 0;
  display: inline-block;
  border: none;
  background: #f1f1f1;
}

input[type=text]:focus, input[type=password]:focus, input[type=email], input[type=file], input[type=url], input[type=date], select {
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
table{
  border-collapse: collapse;
  width: 100%;
}

td, th{
  padding: 10px;
}
</style>
</head>
<body>

<?php include_once "student-sidebar.php"?>

<?php
  include "config.php";
  $rs = pg_query($con, "select * from student where id=".$_SESSION["uid"]);
  $row = pg_fetch_assoc($rs);

  if(isset($_POST["submit"]))
  {
    $id = $_POST["id"];
    $name = $_POST["name"];
    $gender = $_POST["gender"];
    $addr = $_POST["addr"];
    $phone = $_POST["phone"];
    $email = $_POST["email"];
    $psw = $_POST["psw"];
    $dob = $_POST["dob"];
    $ssc_board = $_POST["ssc_board"];
    $ssc_yop = $_POST["ssc_yop"];
    $ssc_per = $_POST["ssc_per"];
    $ssc_cgpa = $_POST["ssc_cgpa"];
    $hsc_board = $_POST["hsc_board"];
    $hsc_yop = $_POST["hsc_yop"];
    $hsc_per = $_POST["hsc_per"];
    $hsc_cgpa = $_POST["hsc_cgpa"];
    $ug_board = $_POST["ug_board"];
    $ug_yop = $_POST["ug_yop"];
    $ug_per = $_POST["ug_per"];
    $ug_cgpa = $_POST["ug_cgpa"];
    $pg_board = $_POST["pg_board"];
    $pg_yop = $_POST["pg_yop"];
    $pg_per = $_POST["pg_per"];
    $pg_cgpa = $_POST["pg_cgpa"];
    $extra = $_POST["extra"];
    $other = $_POST["other"];  
    $edu = $_POST['edu'];

    $con = pg_connect("host=localhost port=5432 dbname=crms user=postgres password=root");

    $result = pg_query($con, "select * from student where student_email='$email' and id<>$id");
    $row = pg_fetch_row($result);

    if($row)
    {
      echo "<script>alert('Student already registered.'); location.href='student-dashboard.php';</script>";
    }
    else
    {
      pg_query($con, "update student set student_name='$name', student_gender='$gender', student_address='$addr', student_phone='$phone', student_email='$email', student_pwd='$psw', student_dob='$dob', ssc_board='$ssc_board', ssc_yop='$ssc_yop', ssc_per='$ssc_per', ssc_cgpa='$ssc_cgpa', hsc_board='$hsc_board', hsc_yop='$hsc_yop', hsc_per='$hsc_per', hsc_cgpa='$hsc_cgpa', ug_board='$ug_board', ug_yop='$ug_yop', ug_per='$ug_per', ug_cgpa='$ug_cgpa', pg_board='$pg_board', pg_yop='$pg_yop', pg_per='$pg_per', pg_cgpa='$pg_cgpa',extra_curriculars='$extra', other_achivement='$other', student_education='$edu' where id=$id");

      $target_file = $id . ".jpg";
      move_uploaded_file($_FILES["logo"]["tmp_name"], "student-photo/".$target_file);    

      echo "<script>alert('Student profile updated successfully.'); location.href='student-dashboard.php';</script>";      
    }
  }
?>
?>

<div class="main">
  <h2>Welcome Student - <?=$_SESSION["name"]?></h2>

<form method="post" enctype="multipart/form-data">
  <div class="container">
    <h3>Student Profile</h3>
    <hr>
    <label for="id"><b>Student ID</b></label>
    <input type="text" name="id" id="id" value="<?=$row['id']?>" readOnly>
    <label for="name"><b>Student Name</b></label>
    <input type="text" placeholder="Enter student name" name="name" id="name" value="<?=$row['student_name']?>" required>
    <label for="gender"><b>Gender</b></label>
    <select name="gender" required>
      <option value="<?=$row['student_gender']?>"><?=$row['student_gender']?></option>
      <option value="">Gender</option>
      <option value="Male">Male</option>
      <option value="Female">Female</option>
    </select>
    <label for="addr"><b>Address</b></label>
    <input type="text" placeholder="Enter student address" name="addr" id="addr" value="<?=$row['student_address']?>" required>
    <label for="phone"><b>Phone</b></label>
    <input type="text" placeholder="Enter 10 digits student phone" name="phone" id="phone" pattern="^[6789]\d{9}$" value="<?=$row['student_phone']?>" required>
    <label for="email"><b>Email</b></label>
    <input type="email" placeholder="Enter student email" name="email" id="email" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,}$" value="<?=$row['student_email']?>" required>
    <label for="psw"><b>Password</b></label>
    <input type="text" placeholder="Enter Password" name="psw" id="psw" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" title="Must contain at least one number and one uppercase and lowercase letter, and at least 8 or more characters" value="<?=$row['student_pwd']?>" required>
    <label for="dob"><b>DOB</b></label>
    <input type="date" placeholder="Enter date of birth" name="dob" id="dob" value="<?=$row['student_dob']?>" required>
    <label for="dob"><b>Qualification</b></label>
    <input type="text" placeholder="Enter highest degree" name="edu" id="dob" value="<?=$row['student_education']?>" required>
    <label for="logo"><b>Student Photo</b></label><br>
    <img src="student-photo/<?=$row['id']?>.jpg" width="150" height="100">
    <input type="file" name="logo" id="logo">
    <label for="logo"><b>Education Details</b></label>
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
      <th><input type="text" name="ssc_board"  value="<?=$row['ssc_board']?>" style="width: 200px;" required></th>
      <th><input type="text" name="ssc_yop"  value="<?=$row['ssc_yop']?>" style="width: 200px;" required></th>
      <th><input type="text" name="ssc_per"  value="<?=$row['ssc_per']?>" style="width: 200px;" required></th>
      <th><input type="text" name="ssc_cgpa"  value="<?=$row['ssc_cgpa']?>" style="width: 200px;" required></th>
    </tr>
    <tr>
      <th>HSC</th>
      <th><input type="text" name="hsc_board"  value="<?=$row['hsc_board']?>" style="width: 200px;" required></th>
      <th><input type="text" name="hsc_yop"  value="<?=$row['hsc_yop']?>" style="width: 200px;" required></th>
      <th><input type="text" name="hsc_per"  value="<?=$row['hsc_per']?>" style="width: 200px;" required></th>
      <th><input type="text" name="hsc_cgpa"  value="<?=$row['hsc_cgpa']?>" style="width: 200px;" required></th>
    </tr>
    <tr>
      <th>Graduation</th>
      <th><input type="text" name="ug_board"  value="<?=$row['ug_board']?>" style="width: 200px;" required></th>
      <th><input type="text" name="ug_yop"  value="<?=$row['ug_yop']?>" style="width: 200px;" required></th>
      <th><input type="text" name="ug_per"  value="<?=$row['ug_per']?>" style="width: 200px;" required></th>
      <th><input type="text" name="ug_cgpa"  value="<?=$row['ug_cgpa']?>" style="width: 200px;" required></th>
    </tr>
    <tr>
      <th>Post Graduation</th>
      <th><input type="text" name="pg_board"  value="<?=$row['pg_board']?>" style="width: 200px;" required></th>
      <th><input type="text" name="pg_yop"  value="<?=$row['pg_yop']?>" style="width: 200px;" required></th>
      <th><input type="text" name="pg_per"  value="<?=$row['pg_per']?>" style="width: 200px;" required></th>
      <th><input type="text" name="pg_cgpa"  value="<?=$row['pg_cgpa']?>" style="width: 200px;" required></th>
    </tr>
    </table><br>
    <label for="extra"><b>Extra Curricular</b></label>
    <input type="text" placeholder="Enter extra curricular activities" name="extra" id="extra" value="<?=$row['extra_curriculars']?>" required>
    <label for="other"><b>Other Achievements</b></label>
    <input type="text" placeholder="Enter other achievements" name="other" id="other" value='<?=$row['other_achivement']?>' required>

    <button type="submit" class="registerbtn" name="submit">Update</button>
    <button type="reset" class="registerbtn">Clear</button>
  </div>
  
</form>

</div>
   
</body>
</html> 
