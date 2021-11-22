<?php

session_start();
if (isset($_SESSION['unique_id'])) {
    include_once "config.php";
    $status = "Offline now";
    $sql = mysqli_query($con, "UPDATE users SET status='$status' WHERE unique_id='" . $_SESSION['unique_id'] . "'");
    if ($sql) {
        session_unset();
        session_destroy();
        header("Location: ../login.php");
    }
} else {
    header("Location: ../login.php");
}