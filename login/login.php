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
    <title>Login</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="login.css" type="text/css">
    <link rel="icon" type="image/png" href="../images/logo">
</head>

<body>
    <?php require '../includes/header_logged_out.html'; ?>
    <div class="container-fluid">
        <div class="panel panel-primary panelwidth">
            <div class="panel-heading">
                <h4 style="font-size: 22px"><b>Login</b></h4>
            </div>
            <div class="panel-body">
                <form method="post" action="user_validation_page.php">
                    <div class="form-group">
                        <label>Email</label>
                        <div class="form-group">
                            <input type="email" class="form-control" name="email" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,3}$" placeholder="Email" value="<?php if (!empty($error)) {echo $_GET["email"];} ?>" required>
                        </div>
                        <label>Password</label>
                        <div class="form-group">
                            <input type="password" class="form-control" name="password"  pattern="(?=^.{6,}$)((?=.*\d)|(?=.*\W+))(?![.\n])(?=.*[A-Z])(?=.*[a-z]).*$" placeholder="Password" required>
                        </div>
                        <?php if (!empty($error)) {
                            echo "<label style='color:red;'>$error</label>";
                        }
                        ?>
                        <center>
                            <div class="form-group">
                                <input type="submit" value="Login" class="button" name="name">
                            </div>
                        </center>
                    </div>
                </form>
                <div class="panel-footer">
                    <a href="../signup/signup.php">Don't have an account? Sign up</a>
                </div>
            </div>
        </div>
    </div>
    <?php require '../includes/footer.html'; ?>
</body>

</html>