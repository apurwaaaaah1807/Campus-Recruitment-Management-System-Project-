<?php session_start()?>

<?php
  if(!isset($_SESSION["uid"])){
    echo "<script>alert('You are not logged in. Please login first to view vacancy');location.href='student-login.php'</script>";
  }
?>
<!DOCTYPE html>
<html>
<head>
  <title>Student</title>
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
</style>
</head>
<body>

<?php include_once "student-sidebar.php"?>

<?php
  include "config.php";
?>
<div class="main">
  <h2>Welcome Student - <?=$_SESSION["name"]?></h2>
    <table>
      <tr>
        <th>ID</th>
        <th>Job Title</th>
        <th>Job Description</th>
        <th>No.of Openings</th>
        <th>Job Location</th>
        <th>Monthly Salary</th>
        <th>Criteria Edu</th>
        <th>Criteria CGPA</th>
        <th>Post Date</th>
        <th>Last Date</th>
        <th>Status</th>
        <th>Action</th>
      </tr>
<?php
  $rs = pg_query($con, "select * from vacancy where company_id=".$_GET['id']." and current_date <= last_date order by id");
      while($row = pg_fetch_assoc($rs)){
?>
    <tr>
      <td><?=$row['id']?></td>
      <td><?=$row['job_title']?></td>
      <td><?=$row['job_description']?></td>
      <td><?=$row['no_of_openings']?></td>
      <td><?=$row['job_location']?></td>
      <td><?=$row['monthly_salary']?></td>
      <td><?=$row['education_criteria']?></td>
      <td><?=$row['cgpa_criteria']?></td>
      <td><?=$row['post_date']?></td>
      <td><?=$row['last_date']?></td>
      <td><?=$row['is_valid']==1?'Visible':'Pending'?></td>
      <td><a href="apply-vacancy.php?id=<?=$row['id']?>">Apply</a></td>
    </tr>
<?php
      }
?>
  </table>
</div>
   
</body>
</html> 
