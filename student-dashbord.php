<?php
session_start();
include ('db_config.php');

if (!isset($_SESSION['message']) || $_SESSION['message'] != "Login Successfully") {
    header("location:index.php");
}

// Retrieve user data from the session
$user = $_SESSION['user'];
if($user['usertype']!= 'student'){
    header("location:index.php");
};
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
    <title>Students' Dashboard</title>
    <link rel="stylesheet" type="text/css" href="student.css" />
    <link rel="stylesheet" href="https://unpkg.com/boxicons@latest/css/boxicons.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
</head>
<body>
    <div class="parent">
       <div class="header">
        <div class="header-logo">
            <img src="img/fuo logo.png" alt="fuo logo" />
        </div>
        <div class="header-text">
            <h2 class="firsttag">FUO Hostel Portal</h2>
            <h2 class="secondtag">Fountain University Osogbo - Hostel Portal</h2>
        </div>
       </div>
       <div class="header-hack"></div>
       <!-- body content -->
       <div class="body-content">
            <div class="another-fillup"></div>
            <div class="body-content-nav">
                <?php include ('swiper.php') ?>
                <a href="student-dashbord.php"><div class="nav-content navi active" id="nav-content"><i class="bi bi-person-circle"></i> Dashboard</div></a>
                <a href="complaint-form.php"><div class="nav-content navi" id="nav-content"> <i class="bi bi-clipboard2-check-fill"></i> Lodge Complaints</div></a>
                <a href="track-complaint.php"><div class="nav-content navi" id="nav-content"> <i class="bi bi-map-fill"></i> Track Complaints</div></a>
                <div class="nav-content"> <button onclick = "window.location.href= 'logout.php'">Log Out <i class="bi bi-box-arrow-right"></i></button></div>
            </div>
            <div class="body-content-content">
                <!-- dashboard -->
                <div class="main-body-dashboard">
                    <div class="time-div">
                        <div class="date-div">
                            <p id="dayy"></p>
                        </div>
                        <div class="time-div-div">
                            <p><span id="hourr"></span>:<span id="min"></span>:<span id="sec"></span> <span id="changee"></span></p>
                        </div>
                    </div>
                    <div class="fillup"></div>
                    <div class="dashboard-Great">
                        <h3><span id="greett"></span><br>
                        <span><span class="name-span"><?php echo htmlspecialchars($user['surname']); ?></span> <br><?php echo htmlspecialchars($user['student_name']); ?></span></h3>
                    </div>
    
                    <div class="dashboard-details">
                        <div class="dashboard-details-master">
                            <div class="dashboard-details-img">
                                <div class="dashboard-img">
                                    <?php echo '<img src="data:image;base64, '.base64_encode($user['image_data']).'" alt="Profile" class="dashboard-imgg">'; ?>
                                </div>
                            </div>
                            <div class="dashboard-details-info">
                                <h4>Matric Number: <br> <span class="dashboard-details-bold"><?php echo htmlspecialchars($user['matric_no']); ?></span></h4>
                                <h4>Level: <br><span class="dashboard-details-bold"><?php echo htmlspecialchars($user['level']); ?></span></h4>
                                <h4>College/Faculty: <br><span class="dashboard-details-bold"><?php echo htmlspecialchars($user['college']); ?></span></h4>
                                <h4>Department: <br><span class="dashboard-details-bold"><?php echo htmlspecialchars($user['department']); ?></span></h4>
                                <h4>Hostel: <br><span class="dashboard-details-bold"><?php echo htmlspecialchars($user['hostel_name']); ?></span></h4>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="footer">
                    <p class="copyy">&copy; 2024 Project | Developed by Ogun Boluwatife</p>
                </div>
            </div>
       </div>
    </div>
    <script src="student.js"></script>
    <script src="swiper.js"></script>
    <script src="auto_logout.js"></script>
</body>
</html>