<?php
require_once('dbhelp.php');

$s_fullname = $s_telephone = $s_email = '';

if (!empty($_POST)) {
    $s_id = '';

    if (isset($_POST['fullname'])) {
        $s_fullname = $_POST['fullname'];
    }

    if (isset($_POST['telephone'])) {
        $s_telephone = $_POST['telephone'];
    }

    if (isset($_POST['email'])) {
        $s_email = $_POST['email'];
    }

    if (isset($_POST['id'])) {
        $s_id = $_POST['id'];
    }

    $s_fullname = str_replace('\'', '\\\'', $s_fullname);
    $s_telephone      = str_replace('\'', '\\\'', $s_telephone);
    $s_email  = str_replace('\'', '\\\'', $s_email);
    $s_id       = str_replace('\'', '\\\'', $s_id);

    if ($s_id != '') {
        //update
        $sql = "update student set fullname = '$s_fullname', telephone = '$s_telephone', email = '$s_email' where id = " .$s_id;
    } else {
        //insert
        $sql = "insert into student(fullname, telephone, email) value ('$s_fullname', '$s_telephone', '$s_email')";
    }

    // echo $sql;

    execute($sql);

    header('Location: index.php');
    die();
}

$id = '';
if (isset($_GET['id'])) {
    $id          = $_GET['id'];
    $sql         = 'select * from student where id = '.$id;
    $studentList = executeResult($sql);
    if ($studentList != null && count($studentList) > 0) {
        $std        = $studentList[0];
        $s_fullname = $std['fullname'];
        $s_telephone      = $std['telephone'];
        $s_email  = $std['email'];
    } else {
        $id = '';
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Registation Form * Form Tutorial</title>
    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">

    <!-- jQuery library -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>

    <!-- Popper JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>

    <!-- Latest compiled JavaScript -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
</head>
<body>
<div class="container">
    <div class="panel panel-primary">
        <div class="panel-heading">
            <h2 class="text-center">Add Student</h2>
        </div>
        <div class="panel-body">
            <form method="post">
                <div class="form-group">
                    <label for="usr">Name:</label>
                    <input type="number" name="id" value="<?=$id?>" style="display: none;">
                    <input required="true" type="text" class="form-control" id="usr" name="fullname" value="<?=$s_fullname?>">
                </div>
                <div class="form-group">
                    <label for="telephone">telephone:</label>
                    <input type="number" class="form-control" id="telephone" name="telephone" value="<?=$s_telephone?>">
                </div>
                <div class="form-group">
                    <label for="email">email:</label>
                    <input type="text" class="form-control" id="email" name="email" value="<?=$s_email?>">
                </div>
                <button class="btn btn-success">Save</button>
            </form>
        </div>
    </div>
</div>
</body>
</html>
