<?php
session_start();
include ('db_config.php');

if (!isset($_SESSION['message']) || $_SESSION['message'] != "Login Successfully") {
    header("location:index.php");
}

// Retrieve user data from the session
$user = $_SESSION['userM'];
$selectedHostel = $_SESSION['hostelSelected'];

if($user['type']!= 'manager'){
    header("location:index.php");
};

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
    <title>Managers' Profile</title>
    <link rel="stylesheet" type="text/css" href="manager.css" />
    <link rel="stylesheet" href="https://unpkg.com/boxicons@latest/css/boxicons.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
</head>

<body>
    <div class="parent">
        <div class="header">
            <div class="nav-toggle" id="nav-toggle"><i class="bi bi-list"></i></div>
            <div class="admin-icon" onclick="window.location.href='manager-profile.php'">
            <?php echo '<img src="data:image;base64, '.base64_encode($user['profile_img']).'" alt="Profile">'; ?>
                <h2>Admin</h2>
            </div>
        </div>
        <nav id="nav">
            <div class="nav-master">
                <div class="nav-header">
                    <div class="nav-header-sub">
                        <img src="img/fuo logo.png" alt="FUO logo">
                        <h2>Fountain University <br>Osogbo<br><span>- Hostel Portal -</span></h2>
                        
                    </div>
                </div>
                <div class="nav-link-div">
                    <ul>
                        <a href="managers-dashboard.php">
                            <li class=""><i class="bi bi-house-door"></i> Dashboard</li>
                        </a>
                        <a href="hostel-students.php">
                            <li class=""><i class="bi bi-people-fill"></i> Hostel Students</li>
                        </a>
                        <a href="manager-lodge-complaint.php">
                            <li class=""><i class="bi bi-map"></i> Lodge Complaint</li>
                        </a>
                        <a href="manage-complaints.php">
                            <li class=""><i class="bi bi-kanban"></i> Manage Complaints</li>
                        </a>
                        <a href="manager-profile.php">
                            <li class="active"><i class="bi bi-person-check-fill"></i> Profile</li>
                        </a>
                        <a href="logout.php">
                            <li class=""><i class="bi bi-box-arrow-right"></i> Log Out</li>
                        </a>
                    </ul>
                </div>
            </div>
        </nav>

        <div class="main-body">
            <div class="main-body-real">
                <div class="main-body-sub">
                    <p class="main-body-sub-p">Profile</p>
                    <div class="hostel-main">
                        <div class="profile-main">
                            <div class="profile-main-sub">
                            <?php echo '<img src="data:image;base64, '.base64_encode($user['profile_img']).'" alt="Profile">'; ?>
                                <p>Surname: <br><span><?php echo htmlspecialchars($user['surname']); ?></span></p>
                                <p>Other Name(s): <br><span><?php echo htmlspecialchars($user['other_names']); ?></span></p>
                                <p>Gender: <br><span><?php echo htmlspecialchars($user['gender']); ?></span></p>
                                <p>Staff Id: <br><span><?php echo htmlspecialchars($user['staff_id']); ?></span></p>
                                <p>Email: <br><span><?php echo htmlspecialchars($user['email']); ?></span></p>
                                <p>Phone No.: <br><span><?php echo htmlspecialchars($user['phone_no']); ?></span></p>
                                <p>Position: <br><span><?php echo htmlspecialchars($user['position']); ?></span></p>
                                <p>Year of Employment: <br><span><?php echo htmlspecialchars($user['year_of_emp']); ?></span></p>
                                <p>Nationality: <br><span><?php echo htmlspecialchars($user['Nationality']); ?></span></p>

                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="footer">
                <p class="copyy">&copy; 2024 Project | Developed by Ogun Boluwatife</p>
            </div>
        </div>

    </div>
    <script src="manager.js"></script>
    <script src="auto_logout.js"></script>
</body>

</html>