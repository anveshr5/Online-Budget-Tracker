<?php
    session_start();
    $con = mysqli_connect("localhost", "root", "", "budgettracker") or die(mysqli_error($con));
    $email = mysqli_real_escape_string($con, $_POST['email']);
    
    $password = md5(md5(mysqli_real_escape_string($con, $_POST['password'])));

    $email_check = "SELECT * from users WHERE (email = '$email' && password = '$password');";
    $email_check_rows = mysqli_query($con, $email_check) or die(mysqli_error($con));
    
    $regex_password = "^\S*(?=\S{8,})(?=\S*[a-z])(?=\S*[A-Z])(?=\S*[\d])\S*$";

    if(!filter_var($email,FILTER_VALIDATE_EMAIL)  || !preg_match($regex_password, $password)){
        $_SESSION['error'] = "Incorrect Email or Password Format";
        header("location: login.php?email=$email");
    }

    $user_row = mysqli_fetch_array($email_check_rows);
    $num = mysqli_num_rows($email_check_rows);
    if($num == 1){
        $_SESSION['email'] = $user_row['email'];
        $_SESSION['id'] = $user_row['id'];
        $_SESSION['phone'] = $user_row['phone'];
        $_SESSION['name'] = $user_row['first_name']." ".$user_row['last_name'];
        header("location: ../homepage/homepage.php");
    } else {
        $_SESSION['error'] = "Incorrect Email or Password";
        header("location: login.php?email=$email");
    }
?>