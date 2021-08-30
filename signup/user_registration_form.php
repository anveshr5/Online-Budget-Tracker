<?php
session_start();
$con = mysqli_connect("localhost", "root", "", "budgettracker") or die(mysqli_error($con));
$email = mysqli_real_escape_string($con, $_POST['email']);
$first_name = mysqli_real_escape_string($con, $_POST['first_name']);
$last_name = mysqli_real_escape_string($con, $_POST['last_name']);
$phone = mysqli_real_escape_string($con, $_POST['phone']);
$password = md5(md5(mysqli_real_escape_string($con, $_POST['password'])));
$c_password = md5(md5(mysqli_real_escape_string($con, $_POST['c_password'])));

$regex_password = "^\S*(?=\S{8,})(?=\S*[a-z])(?=\S*[A-Z])(?=\S*[\d])\S*$";


if (!filter_var($email,FILTER_VALIDATE_EMAIL)) {
    $_SESSION['error'] = "Incorrect Email Format";
    header("location: signup.php?email=$email&phone=$phone&f_name=$first_name&l_name=$last_name");
}
if(!preg_match($regex_password, $password)){
    $_SESSION['error'] = "The passwords do not match the requested format, Please include a lower case, uppercase, a special character and a number";
    header("location: signup.php?email=$email&phone=$phone&f_name=$first_name&l_name=$last_name");
}
function GetImageExtension($imagetype)
{
    if (empty($imagetype)) return false;
    switch ($imagetype) {
        case 'image/bmp':
            return '.bmp';
        case 'image/gif':
            return '.gif';
        case 'image/jpeg':
            return '.jpg';
        case 'image/png':
            return '.png';
        default:
            return false;
    }
}

if ($password == $c_password) {
    $email_check = "SELECT * from users WHERE email = '$email';";
    $phone_check = "Select * from users WHERE phone='$phone';";
    $email_check_rows = mysqli_query($con, $email_check) or die(mysqli_error($con));
    $phone_check_rows = mysqli_query($con, $phone_check) or die(mysqli_error($con));
    $num_e = mysqli_num_rows($email_check_rows);
    $num_p = mysqli_num_rows($phone_check_rows);
    //Checking if email exists, if true redirecting to login
    if ($num_e == 1) {
        $_SESSION['error'] = "Email already exists";
        header("location: ../login/login.php?email=$email");
    } else if($num_p == 1){
        $_SESSION['error'] = "Phone already exists";
        header("location: signup.php?email=$email&phone=$phone&f_name=$first_name&l_name=$last_name");
    } else {
        if (!empty($_FILES["uploadedimage"]["name"])) {
            $file_name = $_FILES["uploadedimage"]["name"];
            $temp_name = $_FILES["uploadedimage"]["tmp_name"];
            $imgtype = $_FILES["uploadedimage"]["type"];
            $ext = GetImageExtension($imgtype);
            $imagename = date("d-m-Y") . "-" . time() . $ext;
            $target_path = "../profile/profilephotos/" . $imagename;
            if (move_uploaded_file($temp_name, $target_path)) {
                $user_registertion_query = "INSERT INTO users(email,first_name,last_name,phone,image,password) VALUES ('$email','$first_name','$last_name','$phone','$imagename','$password')";
                $user_registertion_submit = mysqli_query($con, $user_registertion_query) or die(mysqli_error($con));
                $_SESSION['email'] = $email;
                $_SESSION['id'] = mysqli_insert_id($con);
                $_SESSION['phone'] = $phone;
                $_SESSION['name'] = $first_name . " " . $last_name;
                header('location: ../homepage/homepage.php');
            }
        } else {
            $user_registertion_query = "INSERT INTO users(email,first_name,last_name,phone,image,password) VALUES ('$email','$first_name','$last_name','$phone','noprofile.png','$password')";
            $user_registertion_submit = mysqli_query($con, $user_registertion_query) or die(mysqli_error($con));
            $_SESSION['email'] = $email;
            $_SESSION['id'] = mysqli_insert_id($con);
            $_SESSION['phone'] = $phone;
            $_SESSION['name'] = $first_name . " " . $last_name;
            header('location: ../homepage/homepage.php');
        }
    }
} else {
    $_SESSION['error'] = "Password doesn't match";
    header("location: signup.php?email=$email&phone=$phone&f_name=$first_name&l_name=$last_name");
}
?>