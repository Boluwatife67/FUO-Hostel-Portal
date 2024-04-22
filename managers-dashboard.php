<?php
session_start();
include ('db_config.php');

if (!isset($_SESSION['message']) || $_SESSION['message'] != "Login Successfully") {
    header("location:index.php");
}

// Retrieve user data from the session
$user = isset($_SESSION['userM'])? $_SESSION['userM'] : null;
$selectedHostel = isset($_SESSION['hostelSelected'])? $_SESSION['hostelSelected'] : null;
$num_rows = isset($_SESSION['numRows'])? $_SESSION['numRows'] : 0;

if($user['type']!= 'manager'){
    header("location:index.php");
};

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
    <title>Managers' Dashboard</title>
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
                        <form id="HostelCheck" action="hostel-check.php" method="POST">
                            <select name="hostel_name" id="HostelNames" required>
                              <option value="">--Select hostel name--</option>
                              <option value="Jubrila Ayinla">Jubrila Ayinla</option>
                              <option value="Adegunwa">Adegunwa</option>
                              <option value="FK Lawal 1">FK Lawal 1</option>
                              <option value="FK Lawal 2">FK Lawal 2</option>
                              <option value="Nimbe Adedipe">Nimbe Adedipe</option>
                              <option value="Yusuf Alli">Yusuf Alli</option>
                              <option value="Samabisa">Samabisa</option>
                            </select>
                            <button type="submit">Apply</button>
                        </form>
                    </div>
                </div>
                <div class="nav-link-div">
                    <ul>
                        <a href="managers-dashboard.php">
                            <li class="active"><i class="bi bi-house-door"></i> Dashboard</li>
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
                    <p class="main-body-sub-p">Dashboard | <span><?php 
                    if($selectedHostel){
                        echo htmlspecialchars($selectedHostel['hostel_name']);
                    } else{
                        echo 'No hostel selected yet';
                    }?></span></p>
                    <div class="dashboard-main">
                        <div class="dashboard-counter" style="border-left: 4px solid #6AAF07;">
                            <div class="dashboard-counter-sub">
                                <div class="dashboard-counter-subb">
                                    <h1><?php 
                                        if($num_rows){
                                            echo $num_rows;
                                        } else{
                                            echo '0';
                                        }
                                        ?></h1>
                                    <p>Total Students</p>
                                </div>
                            </div>
                            <div class="dashboard-counter-sub-sub" style="color: #6AAF07;"><i
                                    class="bi bi-people-fill"></i></div>
                        </div>

                        <div class="dashboard-counter" style="border-left: 4px solid #003b1f;">
                            <div class="dashboard-counter-sub">
                                <div class="dashboard-counter-subb">
                                    <h1><?php
                                        if($selectedHostel){
                                            $hostell = $selectedHostel['hostel_name'];
                                        } else{
                                            $hostell = "Not Assigned";
                                        }
                                        
                                        // Query the database for the hostel information
                                        $querym = "SELECT * FROM complaint WHERE hostel_name = '$hostell'";
                                        $resulty = mysqli_query($data, $querym);
                                        $num_comp_rows = mysqli_num_rows($resulty);

                                        if($num_comp_rows){
                                            echo $num_comp_rows;
                                        } else{
                                            echo '0';
                                        }
                                        
                                    ?></h1>
                                    <p>Total Complaints</p>
                                </div>
                            </div>
                            <div class="dashboard-counter-sub-sub" style="color: #003b1f;"><i class="bi bi-kanban"></i>
                            </div>
                        </div>

                        <div class="dashboard-counter" style="border-left: 4px solid #daa520;">
                            <div class="dashboard-counter-sub">
                                <div class="dashboard-counter-subb">
                                    <h1><?php
                                        // Query the database for the hostel information
                                        $querymm = "SELECT * FROM complaint WHERE hostel_name = '$hostell' && status = 'Approved'";
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
                                        $querymmm = "SELECT * FROM complaint WHERE hostel_name = '$hostell' && status = 'Rejected'";
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
                                        $querymm = "SELECT * FROM complaint WHERE hostel_name = '$hostell' && status = 'Completed'";
                                        $resultyy = mysqli_query($data, $querymm);
                                        $num_comp_rowss = mysqli_num_rows($resultyy);

                                        if($num_comp_rowss){
                                            echo $num_comp_rowss;
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