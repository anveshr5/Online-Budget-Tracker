<?php
session_start();
if (isset($_SESSION['email'])) {
    header('location: homepage/homepage.php');
}
?>

<!DOCTYPE html>
<html>

<head>
    <title>Budget</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="index.css" type="text/css">
    <link rel="icon" type="image/png" href="images/logo">
</head>

<body>
    <?php require 'includes/header_index.html' ?>
    <div class="container bg">
        <center>
            <div class="inner-content">
                <h1>Control your budget</h1>
                <h4>Let us help you save money!</h4>
                <a href="login/login.php"><button class="button">Login</button></a>
                <h3>Or New here?</h3>
                <a href="signup/signup.php"><button class="button">Signup</button></a>
            </div>
        </center>
    </div>
    <?php require 'includes/footer.html' ?>
</body>

</html>