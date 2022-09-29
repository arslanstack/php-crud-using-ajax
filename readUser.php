<?php 
    // require dbconfig.php
    require_once 'dbconfig.php';

    if(isset($_POST['id']) && isset($_POST['id']) != ""){
        $userid = $_POST['id'];

        $sql = "SELECT * FROM user WHERE id = '$userid'";
        if(!$result = mysqli_query($conn, $sql)){
            exit(mysqli_error($conn));
        }

        $response = array();

        if(mysqli_num_rows($result) > 0){
            while($row = mysqli_fetch_assoc($result)){
                $response = $row;
            }
        }else{
            $response['status'] = 200;
            $response['message'] = "Data not found!";
        }

        echo json_encode($response);
    } else{
        $response['status'] = 200;
        $response['message'] = "Invalid Request!";
    }
?>
