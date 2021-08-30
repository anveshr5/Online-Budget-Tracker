<?php
session_start();
if (isset($_SESSION['email'])) {
    header('Location: ../homepage/homepage.php');
}
if (isset($_SESSION['error'])) {
    $error = $_SESSION['error'];
    echo "<script>alert('$error');</script>";
    unset($_SESSION['error']);
}
?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="signup.css" type="text/css">
    <title>Sign Up</title>
    <link rel="icon" type="image/png" href="../images/logo">
</head>

<body>
    <?php include '../includes/header_logged_out.html'; ?>
    <div class="container-fluid">
        <div class="panel panel-primary panelwidth">
            <div class="panel-heading">
                <h4><b>Sign Up</b></h4>
            </div>
            <div class="panel-body">
                <form method="post" action="user_registration_form.php" enctype="multipart/form-data">
                    <div class="form-group">

                        <div class="form-group col-sm-6">
                            <label>First Name</label>
                            <input type="text" class="form-control" name="first_name" placeholder="First Name" value="<?php if (!empty($error)) {echo $_GET["f_name"];} ?>" required>
                        </div>

                        <div class="form-group col-sm-6">
                            <label>Last Name</label>
                            <input type="text" class="form-control" name="last_name" placeholder="Last Name" value="<?php if (!empty($error)) {echo $_GET["l_name"]; } ?>" required>
                        </div>

                        <div class="form-group col-sm-12">
                            <label>Email</label>
                            <input type="email" class="form-control" name="email" placeholder="Email" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,3}$" value="<?php if (!empty($error)) {echo $_GET["email"];} ?>" required>
                        </div>

                        <div class="form-group col-sm-12">
                            <label>Phone</label>
                            <input type="text" class="form-control" name="phone" placeholder="Phone" pattern="[0-9].{9,12}" value="<?php if (!empty($error)) {echo $_GET["phone"]; } ?>" required>
                        </div>

                        <div class="form-group col-sm-6">
                            <label>Password</label>
                            <input type="password" class="form-control" name="password" placeholder="Password" pattern="(?=^.{6,}$)((?=.*\d)|(?=.*\W+))(?![.\n])(?=.*[A-Z])(?=.*[a-z]).*$" required>
                        </div>

                        <div class="form-group col-sm-6">
                            <label>Confirm Password</label>
                            <input type="password" class="form-control" name="c_password" placeholder="Confirm Password" pattern="(?=^.{6,}$)((?=.*\d)|(?=.*\W+))(?![.\n])(?=.*[A-Z])(?=.*[a-z]).*$" required>
                        </div>
                        <div class="form-group col-sm-6">
                            <label>Upload Profile</label>
                            <input type="file" class="simple_class" name="uploadedimage">
                        </div>
                        <?php if (!empty($error)) {
                            echo "<label style='color:red;'>$error</label>";
                        }
                        ?>
                        <center>
                            <div class="form-group">
                                <input type="submit" value="Signup" class="button" name="submit" placeholder="name">
                            </div>
                        </center>
                    </div>
                </form>
                <div class="panel-footer">
                    <a href="../login/login.php">Already have an account? Login!</a>
                </div>
            </div>
        </div>
    </div>
    <?php include '../includes/footer.html'; ?>
</body>

</html>