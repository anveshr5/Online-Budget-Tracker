<?php
$con = mysqli_connect('localhost', 'root', '', 'budgettracker') or die(mysqli_error($con));
$plan_id = $_GET['plan_id'];
$title = mysqli_real_escape_string($con, $_POST['title']);
$date = mysqli_real_escape_string($con, $_POST['date']);
$amountspent = mysqli_real_escape_string($con, $_POST['amountspent']);
$person_id = mysqli_real_escape_string($con, $_POST['person']);
$uploaded = 0;

if($amountspent <= 0){
    $_SESSION['error'] = "Please enter valid amount";
    header("Location: addexpense.php?plan_id=$plan_id");
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
        case 'image/webp':
            return '.webp';
        case 'image/JPG':
            return '.jpg';
        default:
            return false;
    }
}
if (!empty($_FILES["uploadedimage"]["name"])) {
    $file_name = $_FILES["uploadedimage"]["name"];
    $temp_name = $_FILES["uploadedimage"]["tmp_name"];
    $imgtype = $_FILES["uploadedimage"]["type"];
    $ext = GetImageExtension($imgtype);
    $imagename = date("d-m-Y") . "-" . time() . $ext;
    $target_path = "../bills/" . $imagename;
    if (move_uploaded_file($temp_name, $target_path)) {
        $add_expense_query = "INSERT INTO expenses (plan_id,title,date,amountspent,person_id,imgname) VALUES ('$plan_id','$title','$date','$amountspent','$person_id','$imagename');";
        $add_expense_submit = mysqli_query($con, $add_expense_query) or die(mysqli_error($con));
        $uploaded = 1;
    } else {
        $_SESSION['error']= "Couldn't upload bill, Try a different image";
        header("location: addexpense.php?plan_id=$plan_id");
    }
} else {
    $add_expense_query = "INSERT INTO expenses (plan_id,title,date,amountspent,person_id) VALUES ('$plan_id','$title','$date','$amountspent','$person_id');";
    $add_expense_submit = mysqli_query($con, $add_expense_query) or die(mysqli_error($con));
    $uploaded = 1;
}
if ($uploaded == 1) {
    $amount_spent_query = "SELECT amountspent FROM plandetails WHERE id = $plan_id";
    $amount_spent_submit = mysqli_query($con, $amount_spent_query) or die(mysqli_error($con));

    $row = mysqli_fetch_array($amount_spent_submit);
    $amount_spent_total = $row['amountspent'] + $amountspent;
    $update_amount_spent_query = "UPDATE plandetails SET amountspent = $amount_spent_total WHERE id = '$plan_id'";
    $update_amount_spent_submit = mysqli_query($con, $update_amount_spent_query) or die(mysqli_error($con));
    header("location: viewplan.php?plan_id=$plan_id");
}
?>
