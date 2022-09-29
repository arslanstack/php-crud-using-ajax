<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <title>Document</title>
</head>

<body>
    <br>
    <div class="container">
        <h1 class="text-dark text-center text-uppercase display-4">Random Database</h1>
        <div class="d-flex justify-content-end">
            <!-- Button trigger modal -->
            <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#exampleModal">
                <span class="fa fa-plus"> </span> Add Record
            </button>

        </div>
        <br>
        <div id="records">

        </div>
        <!-- Modal 5 -->
        <!-- Modal -->
        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">New Record</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form>
                            <div class="form-group">
                                <label for="">Full Name</label>
                                <input type="text" class="form-control" id="name" aria-describedby="emailHelp"
                                    placeholder="Enter name">
                            </div>
                            <div class="form-group">
                                <label for="">Email address</label>
                                <input type="email" class="form-control" id="email" aria-describedby="emailHelp"
                                    placeholder="Enter email">
                            </div>
                            <div class="form-group">
                                <label for="exampleInputPassword1">Password</label>
                                <input type="password" class="form-control" id="pswd" placeholder="Password">
                            </div>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-dark" data-bs-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-success" onclick="addRecord()" data-bs-dismiss="modal">Add
                            Record</button>
                    </div>
                </div>
            </div>
        </div>
        <!-- Modal 5 -->
        <!-- Modal 2 -->
        <!-- Modal -->
        <div class="modal fade" id="updateModal" tabindex="-1" aria-labelledby="updateModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="updateModalLabel">Update Record</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form>
                            <div class="form-group">
                                <label for="">Full Name</label>
                                <input type="text" class="form-control" id="update_name" aria-describedby="emailHelp"
                                    placeholder="Enter name">
                            </div>
                            <div class="form-group">
                                <label for="">Email address</label>
                                <input type="email" class="form-control" id="update_email" aria-describedby="emailHelp"
                                    placeholder="Enter email">
                                <small id="emailHelp" class="form-text text-muted">We'll never share your email with
                                    anyone else.</small>
                            </div>
                            <div class="form-group">
                                <label for="exampleInputPassword1">Password</label>
                                <input type="password" class="form-control" id="update_pswd" placeholder="Password">
                            </div>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-dark" data-bs-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-success" onclick="updateRecord()"
                            data-bs-dismiss="modal">Update</button>
                        <input type="hidden" id="hidden_user_id">
                    </div>
                </div>
            </div>
        </div>



    </div>





    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM"
        crossorigin="anonymous"></script>


    <!-- AJAX CDN-->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script>
        $(document).ready(function () {
            readRecords();
        });

        function readRecords() {
            var readrecord = "readrecord";
            $.ajax({
                url: "readRecords.php",
                type: "post",
                data: {
                    readrecord: readrecord
                },
                success: function (data, status) {
                    $('#records').html(data);
                }
            });
        }


        function addRecord() {
            var name = $("#name").val();
            var email = $("#email").val();
            var pswd = $("#pswd").val();
            $.ajax({
                url: "addRecord.php",
                type: "POST",
                data: {
                    name: name,
                    email: email,
                    pswd: pswd
                },
                success: function (data, status) {
                    if (data != "") {
                        alert("Email already taken or invalid email");
                    }
                    readRecords();
                    $('.form-control').val("");

                }
            });
        }

        function DeleteUser(deleteid) {
            var conf = confirm("Are you sure you want to delete this record?");
            if (conf == true) {
                $.ajax({
                    url: "deleteRecord.php",
                    type: "POST",
                    data: {
                        deleteid: deleteid
                    },
                    success: function (data, status) {
                        readRecords();
                    }
                });
            }
        }

        function GetUserDetails(id) {

            $("#hidden_user_id").val(id);
            $.post("readUser.php", {
                id: id
            },
                function (data, status) {
                    var user = JSON.parse(data);
                    $("#update_name").val(user.name);
                    $("#update_email").val(user.email);
                    $("#update_pswd").val(user.pswd);
                }
            );
            $("#updateModal").modal("show");
        }

        function updateRecord() {
            var hidden_user_id = $("#hidden_user_id").val();
            var update_name = $("#update_name").val();
            var update_email = $("#update_email").val();
            var update_pswd = $("#update_pswd").val();
            $.post("updateRecord.php", {
                hidden_user_id: hidden_user_id,
                update_name: update_name,
                update_email: update_email,
                update_pswd: update_pswd
            },
                function (data, status) {

                    readRecords();
                    if (data != "") {
                        alert("Email already taken or invalid email");
                    }
                }
            );
        }
    </script>


</body>

</html>