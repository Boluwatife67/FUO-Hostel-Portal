<?php
session_start();
include ('db_config.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['staffid'];
    $pass = $_POST['passd'];

    $sql = "SELECT * FROM staff WHERE staff_id='$name' AND password= '$pass'";
    $result = mysqli_query($data, $sql);
    $row = mysqli_fetch_array($result);

    if (mysqli_num_rows($result) == 1 && $row['type'] == "manager") {
        $_SESSION['message'] = "Login Successfully";
        $_SESSION['userM'] = $row; // Store the user data in the session

        
        header("location:managers-dashboard.php");
    } else {
        $_SESSION['message'] = "Invalid Staff ID or Password";
        header("location:index.php");
    }
}
?>