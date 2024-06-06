<?php
session_start();

if (!isset($_SESSION["uid"])) {
  header("Location: index.php");
  return;
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
  <title>Admin</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />

  <style>
    /* Set height of the grid so .sidenav can be 100% (adjust as needed) */
    .row.content {
      height: 10px
    }

    /* Set gray background color and 100% height */
    .sidenav {
      background-color: lightgreen;
      height: 100%;
    }

    .sidenav a {
      text-decoration: none;
      font-size: 15px;
      padding: 10px;
      font-family: sans-serif;
      line-height: 35px;
      color: red;
    }

    .col-sm-8 {
      width: 80%;
    }

    .well {
      background: #e6f3ff !important;
    }

    .btn-warning {
      background-color: rgb(99, 145, 244) !important;
    }

    /* On small screens, set height to 'auto' for the grid */
    @media screen and (max-width: 767px) {
      .row.content {
        height: auto;
      }
    }

    .well {
      background: #e6f3ff;
    }
    .quterly-r{
      position: absolute;
      top: 130px;
      left: 600px;
      width: 100%;
    }
    .report-p{
      position: relative;
      top:-1px;
      left:250px !important;

    }
  </style>
</head>

<body>

<div class="container-fluid">
  <div class="row content">
  	<?php include_once 'admin-sidebar.php'; ?>
  <br>

  <div class="report-p">
      <div class="col-sm-8">
        <div class="well">
          <h4>Dashboard</h4>
          <p>Welcome <b><u><?= $_SESSION["name"] ?></u></b></p>
        </div>
        <div class="row">
          <div class="col-sm-4">

            <form method='post' action='report1.php'>
              <table class="table table-bordered">
                <tr>
                  <td><b>Form Date:</b></td>
                  <td><input type="date" name="sdate" required></td>
                </tr>
                <tr>
                  <td><b>To Date:</b></td>
                  <td><input type="date" name="edate" required></td>
                </tr>
                <tr>
                  <td><input type='submit' value='Show' class='btn btn-warning'></td>
                </tr>
              </table>
            </form>

            <div class="yearly-r">
              <h1>Yearly</h1>
              <form method='post' action='report2.php'>
              <table class="table table-bordered">
                <tr>
                  <td><b>Year:</b></td>
                  <td><input type="number" min=2022 id="startYearly" name="year" required></td>
                </tr>
                <tr>
                  <td><input type='submit' value='Show' class='btn btn-warning'></td>
                </tr>
              </table>
              </form>
            </div>


            <div class="quterly-r">           
              <h1>Quarterly</h1>
              <form method='post' action='report3.php'>
              <table class="table table-bordered">
                <tr>
                  <td><b>Year:</b></td>
                  <td><input id="quarterlyStart" type="number" min=2022 name="year" required></td>
                </tr>
                <tr>
                  <td><input type='submit' value='Show' class='btn btn-warning'></td>
                </tr>
              </table>
              </form>
            </div>

              <h1>Monthly</h1>
              <form method='post' action='report4.php'>
              <table class="table table-bordered">
                <tr>
                  <td><b>Year:</b></td>
                  <td><input id="quarterlyStart" type="number" min=2022 name="year" required></td>
                </tr>
                <tr>
                  <td><b>Month:</b></td>
                  <td>
                    <select name="month" required>
                      <option value="">Select Month</option>
                      <option value="1">Jan</option>
                      <option value="2">Feb</option>
                      <option value="3">Mar</option>
                      <option value="4">Apr</option>
                      <option value="5">May</option>
                      <option value="6">Jun</option>
                      <option value="7">Jul</option>
                      <option value="8">Aug</option>
                      <option value="9">Sep</option>
                      <option value="10">Oct</option>
                      <option value="11">Nov</option>
                      <option value="12">Dec</option>
                    </select>

                  </td>
                </tr>
                <tr>
                  <td><input type='submit' value='Show' class='btn btn-warning'></td>
                </tr>
              </table>
              </form>

          </div>
        </div>
      </div>
    </div>
    </div>
  </div>

  <div class="show-rby-date">

  </div>
  <script>
    const startyearly = document.querySelector("#startYearly");
    const endYearly = document.querySelector("#endYearly");
    const quarterlyStart = document.querySelector("#quarterlyStart");
    const quarterlyEnd = document.querySelector("#quarterlyEnd");
    const monthlyStart = document.querySelector("#monthlyStart");
    const monthlyEnd = document.querySelector("#monthlyEnd");

    startyearly.addEventListener("change", function() {
      let startDate = startyearly.value;
      let today = new Date(startDate)
      today.setFullYear(today.getFullYear() - 1);
      endYearly.value = formatDate(today);

    })
    quarterlyStart.addEventListener("change", function() {
      let startDate = quarterlyStart.value;
      let today = new Date(startDate)
      today.setMonth(today.getMonth() - 4);
      quarterlyEnd.value = formatDate(today);

    })
    monthlyStart.addEventListener("change", function() {
      let startDate = monthlyStart.value;
      let today = new Date(startDate)
      today.setMonth(today.getMonth() - 1);
      monthlyEnd.value = formatDate(today);

    })


    function formatDate(date) {
      var d = new Date(date),
        month = '' + (d.getMonth() + 1),
        day = '' + d.getDate(),
        year = d.getFullYear();

      if (month.length < 2)
        month = '0' + month;
      if (day.length < 2)
        day = '0' + day;

      return [year, month, day].join('-');
    }
  </script>
</body>

</html>