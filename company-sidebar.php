<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="css/dashboard2.css">
    <link href='https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css' rel='stylesheet'>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>

<body>
    <div class="sidebar">
        <div class="logo-details">
            <i class='bx bxl-c-plus-plus'></i>
            <span class="logo_name">CRMS</span>
        </div>
        <ul class="nav-links">
            <li>
                <a href="company-dashboard.php" class="active">
                    <i class='bx bx-grid-alt'></i>
                    <span class="links_name">Dashboard</span>
                </a>
            </li>
            <li>
                <a href="view-company-profile.php">
                    <i class='bx bx-box'></i>
                    <span class="links_name">Profile</span>
                </a>
            </li>
            <li>
                <a href="post-vacancy.php">
                    <i class='bx bx-list-ul'></i>
                    <span class="links_name"> Post Vacancy</span>
                </a>
            </li>
            
            <li>
                <a href="view-reply.php">
                    <i class='bx bx-pie-chart-alt-2'></i>
                    <span class="links_name">View Application</span>
                </a>
            </li>
           
            <li class="log_out">
                <a href="logout.php">
                    <i class='bx bx-log-out'></i>
                    <span class="links_name">Log out</span>
                </a>
            </li>
        </ul>
    </div>
        </div>
        <style>
            .red{
                width: auto;
                position: absolute;
                top: 50%;
                left:50%;
                transform: translate(-50%,-50%);
                display: flex;
            }
            .red .center{
                text-align: center;
            }
            .center h1{
                font-size: 35px;
                font-weight: 600;
            }
            .center p{
                font-size: 18px;
                font-weight: 300;
                margin-top: 8px;
            }
            
            .btns button{
                margin: 0 10px 0 0;
                padding: 10px 30px;
                margin-top: 15px;
            }
            .btns button:hover{
                color:black;
                background: #fff;
            }
        </style>     
  
    
    <script>
        let sidebar = document.querySelector(".sidebar");
        let sidebarBtn = document.querySelector(".sidebarBtn");
        sidebarBtn.onclick = function () {
            sidebar.classList.toggle("active");
            if (sidebar.classList.contains("active")) {
                sidebarBtn.classList.replace("bx-menu", "bx-menu-alt-right");
            } else
                sidebarBtn.classList.replace("bx-menu-alt-right", "bx-menu");
        }
    </script>


</body>

</html>