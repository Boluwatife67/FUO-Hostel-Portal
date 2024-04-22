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
    <title>Track Complaint</title>
    <link rel="stylesheet" type="text/css" href="student.css" />
    <link rel="stylesheet" href="https://unpkg.com/boxicons@latest/css/boxicons.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
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
                <a href="student-dashbord.php"><div class="nav-content navi" id="nav-content"><i class="bi bi-person-circle"></i> Dashboard</div></a>
                <a href="complaint-form.php"><div class="nav-content navi" id="nav-content"> <i class="bi bi-clipboard2-check-fill"></i> Lodge Complaints</div></a>
                <a href="track-complaint.php"><div class="nav-content navi active" id="nav-content"> <i class="bi bi-map-fill"></i> Track Complaints</div></a>
                <div class="nav-content"><button onclick = "window.location.href= 'logout.php'">Log Out <i class="bi bi-box-arrow-right"></i></button></div>
            </div>
            <div class="body-content-content">
                <!-- dashboard -->
                <div class="main-body-complaint">

                    <div class="history-form">
                        <div class="complaint-form-header">
                            <h2>Track Complaints</h2>
                        </div>
                        <div class="filter-div">
                        <input type="search" placeholder="Search" id="searchInput">
                        </div>
                        <div class="complaint-history-body">
                            <div class="real-history">
                                <div class="complaint_history">
                                    <table >
                                        <tr class="heading-real">
                                            <td style="width: 7%;">Id.</td>
                                            <td style="width: 33%;">Type</td>
                                            <td style="width: 15%;">Date/Time</td>
                                            <td style="width: 25%;">Status</td>
                                            <td style="width: 20%;">Action</td>
                                        </tr>
                                        <?php
                                        $filtUser= $user['matric_no'];
                                        $queryy = "SELECT * FROM complaint WHERE matric_no = '$filtUser' ORDER BY date_time DESC";
                                        $resultt = mysqli_query($data, $queryy);
                                        if($resultt){
                                            while($row=mysqli_fetch_assoc($resultt)){
                                                $tid=$row['id'];
                                                $tcomp_type=$row['complaint_type'];
                                                $tt_d=$row['date_time'];
                                                $tstatus=$row['status'];
                                            
                                                echo '

                                                <tr>
                                            <th>'.$tid.'</th>
                                            <td>'.$tcomp_type.'</td>
                                            <td>'.$tt_d.'</td>
                                            <td><div class="status" id="statuss">'.$tstatus.'</div></td>
                                            <td><button class="view view-me" id="'.$tid.'"> View <i class="bi bi-caret-down-fill"></button></td>
                                        </tr>
                                        ';

                                            }
                                        }

                            
                                        ?>
                        
                                    </table>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                

                <div class="footer">
                    <p class="copyy">&copy; 2024 Project | Developed by Ogun Boluwatife</p>
                </div>

                <!-- modal -->
        <div class="overlay hidden"></div>
        <div class="modal hidden" id="mo">
            <span class="close" onclick="closeModal()">&times;</span>
            <div class="modal-subb">
    
            </div>
        </div>
            </div>
       </div>
    </div>
    <script src="search.js"></script>
    <script src="student.js"></script>
    <script src="swiper.js"></script>
    <script src="auto_logout.js"></script>
    <script>
        function printt() {
            // var modd= document.getElementById('mo');
            window.print();
        }
        var viewProfile = document.querySelectorAll(".view-me");
        var overlay = document.querySelector(".overlay");
        var modal = document.querySelector(".modal");

        for (let i = 0; i < viewProfile.length; i++) {
          viewProfile[i].onclick = function () {
            overlay.classList.remove("hidden");
            modal.classList.remove("hidden");
        
            id_emp = $(this).attr('id')
            $.ajax({url: "get_student_complaint_details.php",
            method:'post',
            data:{emp_id: id_emp},
            success: function(result){
              $(".modal-subb").html(result);
            }});
          };
        }

        function closeModal() {
          overlay.classList.add("hidden");
          modal.classList.add("hidden");
        }
    </script>
</body>
</html>