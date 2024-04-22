<?php
session_start();
include ('db_config.php');

if (!isset($_SESSION['message']) || $_SESSION['message'] != "Login Successfully") {
    header("location:index.php");
}

// Retrieve user data from the session
$user = $_SESSION['userM'];
if($user['type']!= 'works'){
    header("location:index.php");
};

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
    <title>Manage Complaints</title>
    <link rel="stylesheet" type="text/css" href="manager.css" />
    <link rel="stylesheet" href="https://unpkg.com/boxicons@latest/css/boxicons.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
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
                            <li class=""><i class="bi bi-house-door"></i> Dashboard</li>
                        </a>
                        <a href="works_complaints.php">
                            <li class="active"><i class="bi bi-people-fill"></i>Manage Complaints</li>
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
                    <p class="main-body-sub-p">Manage Complaints</p>
                    <div class="hostel-main">
                    <input type="search" placeholder="Search" id="searchInput">
                        <div class="hostel-main-table">
                            <div class="hostel-main-table-sub">
                                <table>
                                    <thead>
                                        <tr>
                                            <th style="width: 5%;">S/no.</th>
                                            <th style="width: 35%;">Type</th>
                                            <th style="width: 20%;">Hostel</th>
                                            <th style="width: 20%;">Matric No</th>
                                            <th style="width: 20%;">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    <?php
                                        // Query the database for the hostel information
                                        $querym = "SELECT * FROM complaint WHERE comments = 'Approved by hostel manager' ORDER BY date_time DESC";
                                        $resulty = mysqli_query($data, $querym);
                                        
                                        if($resulty) {
                                            while ($roww = mysqli_fetch_assoc($resulty)) {
                                                $id = $roww['id'];
                                                $type = $roww['complaint_type'];
                                                $hostelname = $roww['hostel_name'];
                                                $matric = $roww['matric_no'];
                                        ?>
                                        <tr>
                                            <td><?php echo $id; ?></td>
                                            <td><?php echo "$type"; ?></td>
                                            <td><?php echo $hostelname; ?></td>
                                            <td><?php echo $matric; ?></td>
                                            <td><button class="view-me" id="<?php echo $id; ?>">View <i class="bi bi-caret-right-fill"></i></button></td>
                                        </tr>

                                                <?php
                                            }}
                                            ?>
                                    </tbody>
                                </table>
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
    <!-- modal -->
    <div class="overlay hidden"></div>
        <div class="modal hidden" id="mo">
            <span class="close" onclick="closeModal()">&times;</span>
            <div class="modal-subb">
    
            </div>
        </div>
    <script src="manager.js"></script>
    <script src="search.js"></script>
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
            $.ajax({url: "get_works_details.php",
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

        function approveComplaint(complaintId) {
    var xhr = new XMLHttpRequest();
    xhr.open("POST", "get_works_details.php", true);
    xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
    xhr.onload = function() {
        if (xhr.status === 200) {
            // Update the status on the page
            // document.getElementById("pop-status").innerHTML = "Approved";
            // document.getElementById("pop-statuss").innerHTML = "Approved by Works Directory";
            window.location.href = "works_complaints.php";
        } else {
            // Handle error
            console.error(xhr.statusText);
        }
    };
    xhr.send("approve=" + complaintId);
}

function rejectComplaint(complaintId) {
    var xhr = new XMLHttpRequest();
    xhr.open("POST", "get_works_details.php", true);
    xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
    xhr.onload = function() {
        if (xhr.status === 200) {
            // Update the status on the page
            // document.getElementById("pop-status").innerHTML = "Rejected";
            // document.getElementById("pop-statuss").innerHTML = "Rejected by Works Directory";
            window.location.href = "works_complaints.php";
        } else {
            // Handle error
            console.error(xhr.statusText);
        }
    };
    xhr.send("reject=" + complaintId);
}
    </script>
       
</body>

</html>