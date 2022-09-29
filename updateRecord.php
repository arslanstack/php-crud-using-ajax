<?php
error_reporting(0);
// require dbconfig.php
require_once 'dbconfig.php';

// Update record
if (isset($_POST['hidden_user_id'])) {
    $hidden_user_id = $_POST['hidden_user_id'];
    $name = $_POST['update_name'];
    $email = $_POST['update_email'];
    $pswd = $_POST['update_pswd'];
    // if inputs not empty then run query
    if (!empty($name) && !empty($email) && !empty($pswd)) {
        $sql = "UPDATE `users` SET `name`='$name',`email`='$email',`pswd`='$pswd' WHERE id = '$hidden_user_id'";
        $result = mysqli_query($conn, $sql);
        if ($result) {
            echo "Data updated successfully";
        } else {
            $data = "Duplicate entry '$email' for key 'email'";
        }
    } else {
        $data = "Please fill all the fields";
    }
}
