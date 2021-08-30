<?php
session_start();

$con = mysqli_connect('localhost', 'root', "", "budgettracker") or die(mysqli_error($con));

$title = mysqli_real_escape_string($con, $_POST['title']);
$fromdate = mysqli_real_escape_string($con, $_POST['fromDate']);
$todate = mysqli_real_escape_string($con, $_POST['toDate']);
$initialBudget = mysqli_real_escape_string($con, $_POST['initialBudget']);
$noOfPeople = mysqli_real_escape_string($con, $_POST['noOfPeople']);

//To check if start data is less than end date
if ($fromdate <= $todate) { 

    // To check if initialbudget or noof people is less than 1
    if ($initialBudget < 1 || $noOfPeople < 1) { 

        $_SESSION['error'] = "Initial Budget and No of People can't be negative";
        header("Location: createNewPlan.php?initialBudget=$initialBudget&noOfPeople=$noOfPeople");
    } else {
        
        // Insert new plan detials into Plan Details Table in Budget Tracker Database
        $creator_id = $_SESSION['id'];
        $plan_detials_query = "INSERT into plandetails(title,fromdate,todate,initialbudget,noofpeople,creator_id) VALUES ('$title','$fromdate','$todate','$initialBudget','$noOfPeople','$creator_id')";
        $plan_detials_submit = mysqli_query($con, $plan_detials_query) or die(mysqli_error($con));
        $plan_detials_id = mysqli_insert_id($con);
        for ($i = 1; $i <= $noOfPeople; $i++) {
            $person_name = mysqli_real_escape_string($con, $_POST["person$i"]);
            $planuser_query = "INSERT INTO planusers (plan_id,user_name) VALUES ('$plan_detials_id','$person_name')";
            $planuser_submit = mysqli_query($con, $planuser_query) or die(mysqli_error($con));
        }
        header("Location: ../viewplan/viewplan.php?plan_id=$plan_detials_id");
    }
} else {
    $_SESSION['error'] = "Must have at least 1 day";
    header("Location: planDetails.php?initialBudget=$initialBudget&noOfPeople=$noOfPeople");
}
?>