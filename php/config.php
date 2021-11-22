<?php
$con = mysqli_connect("localhost", "root", "", "chat");
if (!$con) {
    die("Connection failed: " . mysqli_connect_error());
}