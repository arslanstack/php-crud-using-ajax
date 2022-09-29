 <?php
    //connection with database

    $dbhost = "localhost";
    $dbuser = "root";
    $dbpass = "";
    $dbname = "ajax";

    $conn = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname);

    if(!$conn){
        die("Connection failed: " . mysqli_connect_error());
    }

    //echo "Connected successfully";

    ?>