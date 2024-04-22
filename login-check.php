<?php
session_start();
include ('db_config.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['username'];
    $pass = $_POST['password'];

    $sql = "SELECT * FROM user WHERE matric_no='$name' AND password= '$pass'";
    $result = mysqli_query($data, $sql);
    $row = mysqli_fetch_array($result);

    if (mysqli_num_rows($result) == 1 && $row['usertype'] == "student") {
        $_SESSION['message'] = "Login Successfully";
        $_SESSION['user'] = $row; // Store the user data in the session

        
        header("location:student-dashbord.php");
    } else {
        $_SESSION['message'] = "Invalid Matric no. or Password";
        header("location:index.php");
    }
}
?>