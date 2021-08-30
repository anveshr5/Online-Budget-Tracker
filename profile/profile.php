 <?php
session_start();
if (!isset($_SESSION['email'])) {
    header('Location: ../../index.php');
}
if (!isset($_SESSION['email'])) {
    header('Location: ../index.php');
}
$con = mysqli_connect("localhost", "root", "", "budgettracker") or die(mysqli_error($con));
$creator_id = $_SESSION['id'];
$select_users_query = "SELECT * FROM users WHERE id = '$creator_id'";
$select_users_submit = mysqli_query($con, $select_users_query) or die(mysqli_error($con));
$user = mysqli_fetch_array($select_users_submit);
?>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="profile.css" type="text/css">
    <link rel="icon" type="image/png" href="../images/logo">
    <title>Profile</title>
</head>

<body>
    <?php require "../includes/header_logged_in.html"; ?>

    <div class="container-fluid">
        <div class="row name extra">
            <div>
                <img src="profilephotos/<?php echo $user['image']; ?>" alt="profile picture" class="img-thumbnail dpsize">
            </div>
        </div>
        <div class="row">
            <div class="panel panel-primary panelwidth">
                <div class="panel-heading">
                    <h3 style="font-size: 22px"><b>Profile</b></h3>
                </div>

                <div class="panel-body">
                    <div class="container-fluid">
                        <h6 class="name"><b>First Name</b></h6>
                        <h6 class="value"><?php echo $user['first_name'] ?></h6>
                    </div>

                    <div class="container-fluid">
                        <h6 class="name"><b>Last Name</b></h6>
                        <h6 class="value"><?php echo $user['last_name'] ?></h6>
                    </div>

                    <div class="container-fluid">
                        <h6 class="name"><b>Email</b></h6>
                        <h6 class="value"><?php echo $user['email'] ?></h6>
                    </div>

                    <div class="container-fluid">
                        <h6 class="name"><b>Phone</b></h6>
                        <h6 class="value"><?php echo $user['phone'] ?></h6>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php require "../includes/footer.html" ?>
</body>

</html>