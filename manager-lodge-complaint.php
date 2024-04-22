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
    <title>Lodge Complaint</title>
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
                            <li class="active"><i class="bi bi-map"></i> Lodge Complaint</li>
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
                    <p class="main-body-sub-p">Lodge Complaint</p>
                    <div class="hostel-main">
                        <div class="hostel-main-table">
                            <div class="hostel-main-table-sub new">
                                <div class="mcomplaint-form-body">
                                    <form enctype="multipart/form-data" id="complaintt">
                                        <div class="man-form">
                                            <label for="surname">Surname</label>
                                            <input type="text" name="surname">
                                        </div>
                                        <div class="man-form">
                                            <label for="othername">Other Name</label>
                                            <input type="text" name="othername">
                                        </div>
                                        <div class="man-form">
                                            <label for="staffId">Staff Id</label>
                                            <input type="text" name="staffId">
                                        </div>
                                        <div class="man-form">
                                            <label for="email">Email</label>
                                            <input type="email" name="email">
                                        </div>
                                        <div class="man-form">
                                            <label for="type">Complaint Type</label>
                                            <select id="type" name="type" id="ComplaintType" title="Complaint-type">
                                                <option value="none">-- Complaint Options --</option>
                                                <option value="Electrical Issue">Electrical Issue</option>
                                                <option value="Water Supply">Water Supply</option>
                                                <option value="Carpentry Work/Damage">Carpentry Work/Damage</option>
                                                <option value="Welder work/damage">Welder work/damage</option>
                                                <option value="Restroom Issue">Restroom Issue</option>
                                                <option value="Others">Others</option>
                                            </select>
                                        </div>
                                        <div class="man-form">
                                            <label for="Complaint_Desc">Provide detailed description</label>
                                            <textarea name="Complaint_Desc" id="ComplaintDesc"></textarea>
                                        </div>
                                        <div class="man-form">
                                            <label for="image">Provide a picture of the complaint</label>
                                            <input type="file" name="image" id="file_input" accept="image/*">
                                            
                                        </div>
                                        <img id="preview"><br>
                                        <div class="man-form btm-div">

                                            <div class="buttonn" id="subt">Submit Complaint</div>
                                        </div>
                                        <input type="hidden" id="submitButtonValue" name="submitButtonValue" value="">
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="footer">
                <p class="copyy">&copy; 2024 Project | Developed by Ogun Boluwatife</p>
            </div>
        </div>
        <!-- modal -->
        <div class="overlay hidden" id="overlay"></div>
        <div class="modal hidden" id="modal">
            <div class="modal-sub" id="first-modal">
                <div class="modal-icon">
                    <dotlottie-player src="https://lottie.host/5d8689ac-2813-495d-a8ad-aa21ec79fdf7/BjxfAgjDwW.json" background="transparent" speed="0.3" class="first-icon" loop autoplay></dotlottie-player>
                </div>
                <h2>Re-confirm Submission</h2>
                <button class="danger" id="danger">Cancel</button>
                <button class="proceed" id="proceed">Submit</button>
            </div>

            <!-- <div class="modal-sub" id="second-modal">
                <div class="modal-icon">
                    <dotlottie-player src="https://lottie.host/5eb9b398-918b-46ef-b933-15ef99d5a422/OlgTnytIzw.json" background="transparent" speed="0.7" loop class="second-icon" autoplay></dotlottie-player>
                </div>
                <h2>Submission Successful</h2>
                <h2>Redirecting...</h2>
            </div> -->
        </div>
    </div>

    <script src="manager-complaint.js"></script>
    <script src="manager.js"></script>
    <script src="auto_logout.js"></script>
    <script src="https://unpkg.com/@dotlottie/player-component@latest/dist/dotlottie-player.mjs" type="module"></script>
    <script>
        const input = document.getElementById('file_input');
        const previ = document.getElementById('preview');

        input.addEventListener('change', () => {
            const reader = new FileReader();
            reader.onload = () => {
                previ.src = reader.result;
            };
            reader.readAsDataURL(input.files[0]);
        });
    </script>
</body>

</html>