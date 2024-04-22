<?php
// Connect to the database
include ('db_config.php');
session_start();

// Retrieve the selected hostel name
$hostel_name = $_POST['hostel_name'];

// Query the database for the hostel information
$query = "SELECT * FROM user WHERE hostel_name = '$hostel_name'";
$result = mysqli_query($data, $query);
$hostel = mysqli_fetch_assoc($result);
$num_rows = mysqli_num_rows($result);

$_SESSION['hostelSelected'] = $hostel;
$_SESSION['numRows'] = $num_rows;
header("location:managers-dashboard.php");
?>