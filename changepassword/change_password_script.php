<?php
session_start();
$con = mysqli_connect("localhost", "root", "", "budgettracker") or die(mysqli_error($con));
$email = $_SESSION['email'];
$old_password = md5(md5($_POST['old_pass']));
$new_password = md5(md5($_POST['new_pass']));
$conf_pass = md5(md5($_POST['conf_pass']));

$regex_password = "^\S*(?=\S{8,})(?=\S*[a-z])(?=\S*[A-Z])(?=\S*[\d])\S*$";

//Matchs password with regex
if (!preg_match($regex_password, $old_password) || !preg_match($regex_password, $new_password)) {
    $_SESSION['error'] = "The passwords do not match the requested format, Please include a lower case, uppercase, a special character and a number";
    header("Location: changepassword.php");
}
$check_old_pass = "SELECT password FROM users WHERE email = '$email'";
$check_old_pass_submit = mysqli_query($con, $check_old_pass) or die(mysqli_error($con));
$old_pass_row = mysqli_fetch_array($check_old_pass_submit);
// Checking if old password is correct
if ($old_pass_row[0] == $old_password) {
    //Confirming password is different
    if ($new_password != $old_password) {
        //Confirming passwords are same
        if ($new_password == $conf_pass) {
            $update_password_query = "UPDATE users SET password = '$conf_pass' WHERE email = '$email'";
            $update_password_submit = mysqli_query($con, $update_password_query) or die(mysqli_error($con));
            $_SESSION['error'] = "Password changed successfully";
            header('location: ../homepage/homepage.php');
        } else {
            $_SESSION['error'] = "New Password does not match with Confirm password";
            header('location: changepassword.php');
        }
    } else {
        $_SESSION['error'] = "New Password cannot be old password";
        header('location: changepassword.php');
    }
} else {
    $_SESSION['error'] = "Incorrect old password";
    header('location: changepassword.php');
}
?>