<?php
include 'db_config.php';

if(isset($_POST["emp_id"])) { 
    $output = '';

    $query = "SELECT * FROM complaint WHERE id = '".$_POST["emp_id"]."'";
    $result = mysqli_query($data, $query);
    $output.= '<div class="modal-content">';
    while ($row = mysqli_fetch_array($result)) {    
            $output.= '
            
            <p>Ticket Id: <span>'.$row["ticket_id"].'</p>
            <p>Date & time: <span>'.$row["date_time"].'</span></p>
            <img src="compUploads/'.$row["complaint_img"].'" alt="complaint Image">
            <p>Name: <span>'.$row["surname"].', '.$row["other_names"].'</span></p>
            <p>Matric Number: <span>'.$row["matric_no"].'</span></p>
            <p>Level: <span>'.$row["level"].'</span></p>
            <p>Department: <span>'.$row["department"].'</span></p>
            <p>Hostel Name: <span>'.$row["hostel_name"].'</span></p>
            <p>Room No: <span>'.$row["room_no"].'</span></p>
            <p>Email: <span>'.$row["email"].'</span></p>
            <p>Complaint type: <span>'.$row["complaint_type"].'</span></p>
            <p>Complaint Description: <span>'.$row["complaint_desc"].'</span></p>
            <p>Status: <span>'.$row["status"].'</span></p>
            <p>Comment: <span id="pop-statuss">'.$row["comments"].'</span></p>';
            if($row["comments"]!= 'Completed by works directory') {
                $output.= '<button id="pr" class="approved" style="background-color: green;" onclick="approveComplaint(\''.$row["id"].'\')"><i class="bi bi-check-circle-fill"></i>Complete</button>';
            }
            $output.= '<button onclick="printt()" id="pr"><i class="bi bi-printer-fill"></i> Print</button>
            ';
    }
    $output.= '</div>';
    echo $output;
}

if(isset($_POST["approve"])) {
    $query = "UPDATE complaint SET status = 'Completed', comments = 'Completed by works directory' WHERE id = '".$_POST["approve"]."'";
    mysqli_query($data, $query);
}

?>