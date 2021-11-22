<?php
session_start();

include_once "config.php";

$email = mysqli_real_escape_string($con, $_POST['email']);
$password = mysqli_real_escape_string($con, $_POST['password']);

if (!empty($email) && !empty($password)) {

    // let us check if the email is valid or not
    if (filter_var($email, FILTER_VALIDATE_EMAIL)) {

        // let us check if the email is already registered or not
        $sql = "SELECT * FROM users WHERE email='$email' && password = '$password'";
        $result = mysqli_query($con, $sql);
        $result_check = mysqli_num_rows($result);

        if ($result_check > 0) { // if the email is already registered
            $row = mysqli_fetch_assoc($result);

            $status = "Active now";
            // updating user status to active now if user login successfully
            $sql2 = mysqli_query($con, "UPDATE users SET status = '{$status}' WHERE unique_id = {$row['unique_id']}");
            $_SESSION['unique_id'] = $row['unique_id']; // store the unique id in the session to get the user data in other files
            echo "success";
        } else {
            echo mysqli_error($con);
            echo  "Sorry email or password are not correct";
        }
    } else {
        echo "Invalid email";
    }
} else {
    echo "All fields are required";
}