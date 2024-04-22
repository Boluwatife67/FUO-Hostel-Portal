<?php
session_start();
include ('db_config.php');

if (!isset($_SESSION['message']) || $_SESSION['message'] != "Login Successfully") {
    header("location:index.php");
}

// Retrieve user data from the session
$user = isset($_SESSION['userM'])? $_SESSION['userM'] : null;
if($user['type']!= 'works'){
    header("location:index.php");
};

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
    <title>Works' Dashboard</title>
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
                        <a href="works-dashboard.php">
                            <li class="active"><i class="bi bi-house-door"></i> Dashboard</li>
                        </a>
                        <a href="works_complaints.php">
                            <li class=""><i class="bi bi-people-fill"></i>Manage Complaints</li>
                        </a>
                        <a href="works_approved_complaints.php">
                            <li class=""><i class="bi bi-map"></i>Approved Complaints</li>
                        </a>
                        <a href="works_rejected_complaints.php">
                            <li class=""><i class="bi bi-kanban"></i>Rejected Complaints</li>
                        </a>
                        <a href="works_profile.php">
                            <li class=""><i class="bi bi-person-check-fill"></i> Profile</li>
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
                    <h1 class="main-body-sub-h"><i id="greett"></i> <br><span><?php echo htmlspecialchars($user['surname']); ?>, <?php echo htmlspecialchars($user['other_names']); ?></span></h1>
                    <p class="main-body-sub-p">Dashboard | <span> Works
                    </span></p>
                    <div class="dashboard-main">
                        <div class="dashboard-counter" style="border-left: 4px solid #6AAF07;">
                            <div class="dashboard-counter-sub">
                                <div class="dashboard-counter-subb">
                                    <h1>
                                    <?php
                                        // Query the database for the hostel information
                                        $querym = "SELECT * FROM complaint WHERE comments = 'Approved by hostel manager' OR comments = 'Approved by works directory' OR comments = 'Rejected by works directory' OR comments = 'Completed by works directory'";
                                        $resulty = mysqli_query($data, $querym);
                                        $num_comp_rows = mysqli_num_rows($resulty);

                                        if($num_comp_rows){
                                            echo $num_comp_rows;
                                        } else{
                                            echo '0';
                                        }
                                        
                                    ?>
                                    </h1>
                                    <p>Total Complaints</p>
                                </div>
                            </div>
                            <div class="dashboard-counter-sub-sub" style="color: #6AAF07;"><i
                                    class="bi bi-people-fill"></i></div>
                        </div>
                        
                        <div class="dashboard-counter" style="border-left: 4px solid #daa520;">
                            <div class="dashboard-counter-sub">
                                <div class="dashboard-counter-subb">
                                    <h1><?php
                                        // Query the database for the hostel information
                                        $querymm = "SELECT * FROM complaint WHERE comments = 'Approved by works directory' OR status = 'Completed'";
                                        $resultyy = mysqli_query($data, $querymm);
                                        $num_comp_rowss = mysqli_num_rows($resultyy);

                                        if($num_comp_rowss){
                                            echo $num_comp_rowss;
                                        } else{
                                            echo '0';
                                        }
                                    ?></h1>
                                    <p>Approved</p>
                                </div>
                            </div>
                            <div class="dashboard-counter-sub-sub" style="color: #daa520;"><i
                                    class="bi bi-check-circle-fill"></i></div>
                        </div>

                        <div class="dashboard-counter" style="border-left: 4px solid red;">
                            <div class="dashboard-counter-sub">
                                <div class="dashboard-counter-subb">
                                    <h1><?php
                                        // Query the database for the hostel information
                                        $querymmm = "SELECT * FROM complaint WHERE comments = 'Rejected by works directory'";
                                        $resultyyy = mysqli_query($data, $querymmm);
                                        $num_comp_rowsss = mysqli_num_rows($resultyyy);

                                        if($num_comp_rowsss){
                                            echo $num_comp_rowsss;
                                        } else{
                                            echo '0';
                                        }
                                    ?></h1>
                                    <p>Rejected</p>
                                </div>
                            </div>
                            <div class="dashboard-counter-sub-sub" style="color: red;"><i class="bi bi-x-circle"></i>
                            </div>
                        </div>
                        <div class="dashboard-counter" style="border-left: 4px solid green;">
                            <div class="dashboard-counter-sub">
                                <div class="dashboard-counter-subb">
                                    <h1><?php
                                        // Query the database for the hostel information
                                        $querymmm = "SELECT * FROM complaint WHERE comments = 'Completed by works directory'";
                                        $resultyyy = mysqli_query($data, $querymmm);
                                        $num_comp_rowsss = mysqli_num_rows($resultyyy);

                                        if($num_comp_rowsss){
                                            echo $num_comp_rowsss;
                                        } else{
                                            echo '0';
                                        }
                                    ?></h1>
                                    <p>Completed</p>
                                </div>
                            </div>
                            <div class="dashboard-counter-sub-sub" style="color: green;"><i
                                    class="bi bi-check2-square"></i></div>
                        </div>

                        <div class="dashboard-counter" style="border-left: 4px solid #003b1f;">
                            <div class="dashboard-counter-sub">
                                <div class="dashboard-counter-subb">
                                    <h1><?php
                                        // Query the database for the hostel information
                                        $querym = "SELECT * FROM complaint WHERE hostel_name = 'Jubrila Ayinla' AND (comments = 'Approved by hostel manager' OR comments = 'Approved by works directory' OR comments = 'Rejected by works directory' OR comments = 'Completed by works directory')";
                                        $resulty = mysqli_query($data, $querym);
                                        $num_comp_rows = mysqli_num_rows($resulty);

                                        if($num_comp_rows){
                                            echo $num_comp_rows;
                                        } else{
                                            echo '0';
                                        }
                                        
                                    ?></h1>
                                    <p>Jubrila Ayinla Complaints</p>
                                </div>
                            </div>
                            <div class="dashboard-counter-sub-sub" style="color: #003b1f;"><i class="bi bi-kanban"></i>
                            </div>
                        </div>

                        <div class="dashboard-counter" style="border-left: 4px solid #003b1f;">
                            <div class="dashboard-counter-sub">
                                <div class="dashboard-counter-subb">
                                    <h1><?php
                                        // Query the database for the hostel information
                                        $querym = "SELECT * FROM complaint WHERE hostel_name = 'Adegunwa' AND (comments = 'Approved by hostel manager' OR comments = 'Approved by works directory' OR comments = 'Rejected by works directory' OR comments = 'Completed by works directory')";
                                        $resulty = mysqli_query($data, $querym);
                                        $num_comp_rows = mysqli_num_rows($resulty);

                                        if($num_comp_rows){
                                            echo $num_comp_rows;
                                        } else{
                                            echo '0';
                                        }
                                        
                                    ?></h1>
                                    <p>Adegunwa Complaints</p>
                                </div>
                            </div>
                            <div class="dashboard-counter-sub-sub" style="color: #003b1f;"><i class="bi bi-kanban"></i>
                            </div>
                        </div>

                        <div class="dashboard-counter" style="border-left: 4px solid #003b1f;">
                            <div class="dashboard-counter-sub">
                                <div class="dashboard-counter-subb">
                                    <h1><?php
                                        // Query the database for the hostel information
                                        $querym = "SELECT * FROM complaint WHERE hostel_name = 'FK Lawal 1' AND (comments = 'Approved by hostel manager' OR comments = 'Approved by works directory' OR comments = 'Rejected by works directory' OR comments = 'Completed by works directory')";
                                        $resulty = mysqli_query($data, $querym);
                                        $num_comp_rows = mysqli_num_rows($resulty);

                                        if($num_comp_rows){
                                            echo $num_comp_rows;
                                        } else{
                                            echo '0';
                                        }
                                        
                                    ?></h1>
                                    <p>FK Lawal 1 Complaints</p>
                                </div>
                            </div>
                            <div class="dashboard-counter-sub-sub" style="color: #003b1f;"><i class="bi bi-kanban"></i>
                            </div>
                        </div>

                        <div class="dashboard-counter" style="border-left: 4px solid #003b1f;">
                            <div class="dashboard-counter-sub">
                                <div class="dashboard-counter-subb">
                                    <h1><?php
                                        // Query the database for the hostel information
                                        $querym = "SELECT * FROM complaint WHERE hostel_name = 'FK Lawal 2' AND (comments = 'Approved by hostel manager' OR comments = 'Approved by works directory' OR comments = 'Rejected by works directory' OR comments = 'Completed by works directory')";
                                        $resulty = mysqli_query($data, $querym);
                                        $num_comp_rows = mysqli_num_rows($resulty);

                                        if($num_comp_rows){
                                            echo $num_comp_rows;
                                        } else{
                                            echo '0';
                                        }
                                        
                                    ?></h1>
                                    <p>FK Lawal 2 Complaints</p>
                                </div>
                            </div>
                            <div class="dashboard-counter-sub-sub" style="color: #003b1f;"><i class="bi bi-kanban"></i>
                            </div>
                        </div>
                        <div class="dashboard-counter" style="border-left: 4px solid #003b1f;">
                            <div class="dashboard-counter-sub">
                                <div class="dashboard-counter-subb">
                                    <h1><?php
                                        // Query the database for the hostel information
                                        $querym = "SELECT * FROM complaint WHERE hostel_name = 'Nimbe Adedipe' AND (comments = 'Approved by hostel manager' OR comments = 'Approved by works directory' OR comments = 'Rejected by works directory' OR comments = 'Completed by works directory')";
                                        $resulty = mysqli_query($data, $querym);
                                        $num_comp_rows = mysqli_num_rows($resulty);

                                        if($num_comp_rows){
                                            echo $num_comp_rows;
                                        } else{
                                            echo '0';
                                        }
                                        
                                    ?></h1>
                                    <p>Nimbe Adedipe Complaints</p>
                                </div>
                            </div>
                            <div class="dashboard-counter-sub-sub" style="color: #003b1f;"><i class="bi bi-kanban"></i>
                            </div>
                        </div>

                        <div class="dashboard-counter" style="border-left: 4px solid #003b1f;">
                            <div class="dashboard-counter-sub">
                                <div class="dashboard-counter-subb">
                                    <h1><?php
                                        // Query the database for the hostel information
                                        $querym = "SELECT * FROM complaint WHERE hostel_name = 'Yusuf Alli' AND (comments = 'Approved by hostel manager' OR comments = 'Approved by works directory' OR comments = 'Rejected by works directory' OR comments = 'Completed by works directory')";
                                        $resulty = mysqli_query($data, $querym);
                                        $num_comp_rows = mysqli_num_rows($resulty);

                                        if($num_comp_rows){
                                            echo $num_comp_rows;
                                        } else{
                                            echo '0';
                                        }
                                        
                                    ?></h1>
                                    <p>Yusuf Alli Complaints</p>
                                </div>
                            </div>
                            <div class="dashboard-counter-sub-sub" style="color: #003b1f;"><i class="bi bi-kanban"></i>
                            </div>
                        </div>

                        <div class="dashboard-counter" style="border-left: 4px solid #003b1f;">
                            <div class="dashboard-counter-sub">
                                <div class="dashboard-counter-subb">
                                    <h1><?php
                                        // Query the database for the hostel information
                                        $querym = "SELECT * FROM complaint WHERE hostel_name = 'Samabisa' AND (comments = 'Approved by hostel manager' OR comments = 'Approved by works directory' OR comments = 'Rejected by works directory' OR comments = 'Completed by works directory')";
                                        $resulty = mysqli_query($data, $querym);
                                        $num_comp_rows = mysqli_num_rows($resulty);

                                        if($num_comp_rows){
                                            echo $num_comp_rows;
                                        } else{
                                            echo '0';
                                        }
                                        
                                    ?></h1>
                                    <p>Samabisa Complaints</p>
                                </div>
                            </div>
                            <div class="dashboard-counter-sub-sub" style="color: #003b1f;"><i class="bi bi-kanban"></i>
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
    <script src="student.js"></script>
    <script src="auto_logout.js"></script>
</body>

</html>