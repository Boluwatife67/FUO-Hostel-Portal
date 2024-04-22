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

if(isset($_POST['submitButtonValue']) && $_POST['submitButtonValue'] == 'submitButtonValue') {
    $subSurname = $user['surname'];
    $substudent_name = $user['student_name'];
    $submatric_no = $user['matric_no'];
    $subemail = $user['email'];
    $sublevel = $user['level'];
    $subhostel_name = $user['hostel_name'];
    $subroom_no = $_POST['room_no'];
    $subComplaint_type = $_POST['Complaint_type'];
    $subComplaint_Desc = mysqli_real_escape_string($data, $_POST['Complaint_Desc']);
    $subcollege = $user['college'];
    $subdepartment = $user['department'];
    // $file = file_get_contents($_FILES['Image']['tmp_name']);
    // $dst_db =  base64_encode($file);
    $image = $_FILES['image'];

    $image_name  = $image['name'];
    $tmp_name    = $image['tmp_name'];
    $error       = $image['error'];
    if($error === 0){

        $img_ex = pathinfo($image_name, PATHINFO_EXTENSION);
        $img_ex_lc = strtolower($img_ex);

        $allowed_exs = array('jpg', 'jpeg', 'png', 'gif');

        if(in_array($img_ex_lc, $allowed_exs)) {

            $new_img_name = uniqid('IMG-', true).'.'.$img_ex_lc;
            $image_upload_path = 'compUploads/'.$new_img_name;

            // $query = "INSERT INTO uploads (guest_name, image_name, usertype) VALUES ('$guestReal',?, 'guest')";
            $query = "INSERT INTO complaint (matric_no, surname, other_names, level, email, college, department, hostel_name, room_no, complaint_type, complaint_desc, complaint_img, date_time, status, comments) 
    VALUES ('$submatric_no', '$subSurname', '$substudent_name', '$sublevel', '$subemail', '$subcollege', '$subdepartment', '$subhostel_name', '$subroom_no', '$subComplaint_type', '$subComplaint_Desc',?, NOW(), 'Pending', 'Submitted by student')";

            $stmt = $data->prepare($query);
            $stmt->execute([$new_img_name]);

            move_uploaded_file($tmp_name, $image_upload_path);

            $em ="Submitted Successfully";
            header("Location: complaint-form.php?error=$em");

        } else{
            $em ="Invalid file type";

            header("Location: complaint-form.php?error=$em");
        }
    }else{
        $em ="Unknown error occurred while Submitting";

        header("Location: complaint-form.php?error=$em");
    }
};
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
    <title>Complaint Form</title>
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
                <a href="student-dashbord.php">
                    <div class="nav-content navi" id="nav-content"><i class="bi bi-person-circle"></i> Dashboard</div>
                </a>
                <a href="complaint-form.php">
                    <div class="nav-content navi active" id="nav-content"> <i class="bi bi-clipboard2-check-fill"></i>
                        Lodge Complaints</div>
                </a>
                <a href="track-complaint.php">
                    <div class="nav-content navi" id="nav-content"> <i class="bi bi-map-fill"></i> Track Complaints
                    </div>
                </a>
                <div class="nav-content"><button onclick = "window.location.href= 'logout.php'">Log Out <i class="bi bi-box-arrow-right"></i></button></div>
            </div>
            <div class="body-content-content">
                <!-- dashboard -->
                <div class="main-body-complaint">

                    <div class="complaint-form">
                        <div class="complaint-form-header">
                            <h2>Hostel Complaint Form</h2>
                        </div>
                        
                        <?php
                        if(isset($_GET['error'])){
                            echo '<div class="container-close" id="logclose">';
                            echo "<p class='errorn'><i class='bi bi-info-circle-fill roundd'></i>";
                                echo htmlspecialchars($_GET['error']);
                            echo "</p>";
                            echo "</div>";
                        }
                        ?>
                        <div class="complaint-form-body">
                            <div class="real-form">
                                <form id="Complaint" action="#" method="POST" enctype="multipart/form-data">
        
                                    <?php echo '<input type="text" class="form-control" disabled name="surname" value="' . $user['surname'] . '">'; ?>
                                    <?php echo '<input type="text" class="form-control" disabled name="student_name" value="' . $user['student_name'] . '">'; ?>
                                    <?php echo '<input type="text" class="form-control" disabled name="matric_no" value="' . $user['matric_no'] . '">'; ?>
                                    <?php echo '<input type="text" class="form-control" disabled name="level" value="' . $user['level'] . '">'; ?>
                                    <?php echo '<input type="text" class="form-control" disabled name="email" value="' . $user['email'] . '">'; ?>
                                    <?php echo '<input type="text" class="form-control" disabled name="hostel_name" value="' . $user['hostel_name'] . '">'; ?>
                                    <input type="text" class="form-control" placeholder="Room Number" id="roomNO" name="room_no"/>
                                    <select title="Complaint-type" class="form-control" id="ComplaintType"  name="Complaint_type">
                                        <option value="0">-- Complaint Options --</option>
                                        <option value="Electrical Issue">Electrical Issue</option>
                                        <option value="Water Supply">Water Supply</option>
                                        <option value="Carpentry Work/Damage">Carpentry Work/Damage</option>
                                        <option value="Welder work/damage">Welder work/damage</option>
                                        <option value="Restroom Issue">Restroom Issue</option>
                                        <option value="Others">Others</option>
                                    </select>
                                    <textarea name="Complaint_Desc" id="ComplaintDesc"
                                        placeholder="Provide detailed description of the complaint"></textarea>
                                    <p>Provide a picture of the complaint</p>
                                    <input type="file" name="image" id="file_input" accept="image/*"
                                        class="form-control">
                                    <img id="preview"><br>
                                    <div class="button_holder">
                                  
                                    <div class="buttonn" id="subt">Submit Complaint</div>
                                    </div>
                                    <input type="hidden" id="submitButtonValue" name="submitButtonValue" value="">
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal hidden" id="modal">
                    <div class="modal-sub" id="first-modal">
                        <div class="modal-icon">
                            <dotlottie-player src="https://lottie.host/5d8689ac-2813-495d-a8ad-aa21ec79fdf7/BjxfAgjDwW.json" background="transparent" speed="0.3" class="first-icon" loop autoplay></dotlottie-player>
                        </div>
                        <h2>Re-confirm Submission</h2>
                        <button class="danger" id="danger">Cancel</button>
                        <button class="proceed" id="proceed">Submit</button>
                    </div>

                    <div class="modal-sub" id="second-modal">
                        <div class="modal-icon">
                            <dotlottie-player src="https://lottie.host/5eb9b398-918b-46ef-b933-15ef99d5a422/OlgTnytIzw.json" background="transparent" speed="0.7" loop class="second-icon" autoplay></dotlottie-player>
                        </div>
                        <h2>Submission Successful</h2>
                        <h2>Redirecting...</h2>
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
    <script src="complaint.js"></script>

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