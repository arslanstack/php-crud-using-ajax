<?php 
error_reporting(0);
    // require dbconfig.php
    require_once 'dbconfig.php';

    extract($_POST);

    if(isset($_POST['name']) && isset($_POST['email']) && isset($_POST['pswd'])){
        $name = $_POST['name'];
        $email = $_POST['email'];
        $pswd = $_POST['pswd'];
        echo "  Name: $name
                Email: $email
                Password: $pswd";
        // if inputs not empty then run query
        if(!empty($name) && !empty($email) && !empty($pswd)){
            $sql = "INSERT INTO `users` (`name`, `email`, `pswd`) VALUES ('$name', '$email', '$pswd')";
            $result = mysqli_query($conn, $sql);
            if($result){
                echo "Data inserted successfully";
            }else{
                $data = "Duplicate entry '$email' for key 'email'";
            }
        }
        else{
            $data = "Please fill all the fields";
        }
    }
?>