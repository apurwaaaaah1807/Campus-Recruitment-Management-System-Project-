<?php
  session_start();

  include "config.php";
  
  $sid = $_SESSION["uid"];
  $jid = $_GET["id"];

  $rs = pg_query($con, "select * from student where id=$sid");
  $row = pg_fetch_assoc($rs);
  $edu = strtolower($row['student_education']);

  $ssc = (int)$row['ssc_cgpa'];
  $hsc = (int)$row['hsc_cgpa'];
  $ug = (int)$row['ug_cgpa'];
  $pg = (int)$row['pg_cgpa'];

  $rs = pg_query($con, "select * from vacancy where lower(education_criteria) like '%$edu%' and id=$jid");

  $n = pg_num_rows($rs);

  if($n==0){
    echo "<script>alert('Your don\'t statisfy education criteria');location.href='student-dashboard.php'</script>";
    exit();
  }

  $rs = pg_query($con, "select * from vacancy where (CAST(cgpa_criteria AS INTEGER)<=$ssc or CAST(cgpa_criteria AS INTEGER)<=$hsc or CAST(cgpa_criteria AS INTEGER)<=$ug or CAST(cgpa_criteria AS INTEGER)<=$pg) and id=$jid");

  $n = pg_num_rows($rs);

  if($n==0){
    echo "<script>alert('Your don\'t statisfy CGPA criteria');location.href='student-dashboard.php'</script>";
    exit();
  }

  $rs = pg_query($con, "select * from application where sid=$sid and jid=$jid");
  $n = pg_num_rows($rs);
  if($n>0){
	echo "<script>alert('Your have already applied for this post. Keep checking your application history for update');location.href='view-student-company.php';</script>";
  }
  else{
  	pg_query($con, "insert into application(sid, jid) values($sid, $jid)");
?>
<script type="text/javascript">
	alert("Your application is submitted successfully. Keep checking your application history for update");
	location.href = "view-student-company.php";
</script>
<?php
	}
?>