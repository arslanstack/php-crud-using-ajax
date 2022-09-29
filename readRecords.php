<?php 

    // require dbconfig.php
    require_once 'dbconfig.php';

    if(isset($_POST['readrecord'])){
        $data = '<table class="table table-bordered table-striped">
                    <thead class="table-dark">
                        <tr>
                            <th>No.</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Password</th>
                            <th>Edit Action</th>
                            <th>Delete Action</th>
                        </tr>
                    </thead>
                    <tbody>';

        $displayquery = "SELECT * FROM user";
        $result = mysqli_query($conn, $displayquery);

        if(mysqli_num_rows($result) > 0){
            $number = 1;
            while($row = mysqli_fetch_array($result)){
                $data .= '<tr>
                            <td>'.$number.'</td>
                            <td>'.$row['name'].'</td>
                            <td>'.$row['email'].'</td>
                            <td>'.$row['pswd'].'</td>
                            <td>
                                <button onclick="GetUserDetails('.$row['id'].')" class="btn btn-warning">Edit</button>
                            </td>
                            <td>
                                <button onclick="DeleteUser('.$row['id'].')" class="btn btn-danger">Delete</button>
                            </td>
                        </tr>';
                $number++;
            }
        }

        $data .= ' </tbody>
        </table>';
        echo $data;
    }



?>