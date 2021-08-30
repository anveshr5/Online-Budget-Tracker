<?php
session_start();
if (!isset($_SESSION['email'])) {
    header('Location: ../../index.php');
}
if (isset($_SESSION['error'])) {
    $error = $_SESSION['error'];
    echo "<script>alert('$error')</script>";
    unset($_SESSION['error']);
}
?>

<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="changepassword.css" type="text/css">
    <link rel="icon" type="image/png" href="../images/logo">
    <title>Change Password</title>
</head>

<body>
    <?php require '../includes/header_logged_in.html' ?>
    <div class="container-fluid">
        <div class="right">
            <div class="panel panel-primary panelwidth">
                <div class="panel-heading">
                    <h4><b>Change Password</b></h4>
                </div>
                <div class="panel-body">
                    <form method="post" action="change_password_script.php">
                        <div class="form-group">
                            <label>Old Password</label>
                            <div class="form-group">
                                <input type="password" placeholder="Old password" class="form-control" pattern="(?=^.{6,}$)((?=.*\d)|(?=.*\W+))(?![.\n])(?=.*[A-Z])(?=.*[a-z]).*$" name="old_pass" required>
                            </div>
                            <label>New Password</label>
                            <div class="form-group">
                                <input type="password" placeholder="New password" class="form-control" pattern="(?=^.{6,}$)((?=.*\d)|(?=.*\W+))(?![.\n])(?=.*[A-Z])(?=.*[a-z]).*$" name="new_pass" required>
                            </div>
                            <label>Confirm New Password</label>
                            <div class="form-group">
                                <input type="password" placeholder="Confirm password" class="form-control" pattern="(?=^.{6,}$)((?=.*\d)|(?=.*\W+))(?![.\n])(?=.*[A-Z])(?=.*[a-z]).*$" name="conf_pass" required>
                            </div>
                            <center>
                                <div class="form-group">
                                    <input type="submit" value="Change Password" class="button" name="name" placeholder="name">
                                </div>
                            </center>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <?php require '../includes/footer.html'; ?>
</body>

</html>