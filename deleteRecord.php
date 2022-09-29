<?php 
    // require dbconfig.php
    require_once 'dbconfig.php';

    if(isset($_POST['deleteid'])){
        $userid = $_POST['deleteid'];
        $sql = "DELETE FROM user WHERE id = '$userid'";
        if(mysqli_query($conn, $sql)){
            echo "Record deleted successfully";
        }else{
            echo "Error: " . $sql . "<br>" . mysqli_error($conn);
        }
    }

?>