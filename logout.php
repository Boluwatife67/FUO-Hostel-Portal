<?php
session_start();
$_SESSION['message'] = "Logout Successfully";
// session_destroy();

header("location:index.php");
exit();
?>