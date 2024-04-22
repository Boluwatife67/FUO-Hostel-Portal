<?php
include 'db_config.php';

if(isset($_POST["emp_id"])) { 
    $output = '';

    $query = "SELECT * FROM user WHERE id = '".$_POST["emp_id"]."'";
$result = mysqli_query($data, $query);
$output .= '<div class="modal-content">';
while ($row = mysqli_fetch_array($result)) {    
        $output .= '
        
                    <img src="data:image;base64, '.base64_encode($row['image_data']).'" alt="Profile">
                    <p>Name: <span>'.$row["surname"].', '.$row["student_name"].'</span></p>
                    <p>Matric Number: <span>'.$row["matric_no"].'</span></p>
                    <p>Level: <span>'.$row["level"].'</span></p>
                    <p>College: <span>'.$row["college"].'</span></p>
                    <p>Department: <span>'.$row["department"].'</span></p>
                    <p>Hostel Name: <span>'.$row["hostel_name"].'</span></p>
                    <p>Gender: <span>'.$row["gender"].'</span></p>
                    <p>Email: <span>'.$row["email"].'</span></p>

                ';
    }
    $output .= '</div>';
    echo $output;
}
?>