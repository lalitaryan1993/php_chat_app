<?php
session_start();

include_once "config.php";

$fname = mysqli_real_escape_string($con, $_POST['fname']);
$lname = mysqli_real_escape_string($con, $_POST['lname']);
$email = mysqli_real_escape_string($con, $_POST['email']);
$password = mysqli_real_escape_string($con, $_POST['password']);

if (!empty($fname) && !empty($lname) && !empty($email) && !empty($password)) {

    // let us check if the email is valid or not
    if (filter_var($email, FILTER_VALIDATE_EMAIL)) {

        // let us check if the email is already registered or not
        $sql = "SELECT * FROM users WHERE email='$email'";
        $result = mysqli_query($con, $sql);
        $result_check = mysqli_num_rows($result);

        if ($result_check > 0) { // if the email is already registered
            echo  "'$email' - This Email already registered";
        } else {
            // let check user upload a profile picture or not
            if (isset($_FILES['image'])) {
                $image_name = $_FILES['image']['name'];
                $image_size = $_FILES['image']['size'];
                $image_tmp = $_FILES['image']['tmp_name'];
                $image_type = $_FILES['image']['type'];
                $image_ext = explode('.', $image_name);
                $image_ext = strtolower(end($image_ext));
                $allowed = array('jpg', 'jpeg', 'png');

                if (in_array($image_ext, $allowed)) {
                    if ($image_size < 5000000) {
                        $image = "image_" . uniqid('', true) . "." . $image_ext;
                        $image_path = "images/" . $image;
                        if (move_uploaded_file($image_tmp, $image_path)) {
                            $status = "Active now";
                            $rand_id = rand(time(), 10000000); // generate a random id
                            // let us insert the data into the database
                            $sql = "INSERT INTO users (fname, unique_id, lname, email, password, image, status) VALUES ('$fname', {$rand_id}, '$lname', '$email', '$password', '$image', '$status')";
                            $result = mysqli_query($con, $sql);
                            if ($result) {
                                $sql3 = mysqli_query($con, "SELECT * FROM users WHERE email='$email'");
                                if (mysqli_num_rows($sql3) > 0) {
                                    $row = mysqli_fetch_assoc($sql3);

                                    $_SESSION['unique_id'] = $row['unique_id']; // store the unique id in the session to get the user data in other files
                                    echo "success";
                                }
                            } else {
                                echo "Something went wrong";
                                echo mysqli_error($con);
                            }
                        }
                    } else {
                        echo "Your file is too big";
                    }
                } else {
                    echo "You cannot upload files of this type";
                }
            } else {
                echo "Please select image";
            }
        }
    } else {
        echo "Invalid email";
    }
} else {
    echo "All fields are required";
}