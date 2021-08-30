<?php
session_start();
if (!isset($_SESSION['email'])) {
    header('Location: index.php');
}
$con = mysqli_connect("localhost", "root", "", "budgettracker") or die(mysqli_error($con));
$plan_id = $_GET['plan_id'];

$select_plans_details_query = "SELECT * FROM plandetails WHERE id = '$plan_id'";
$select_plans_details_submit = mysqli_query($con, $select_plans_details_query) or die(mysqli_error($con));
$plan_details = mysqli_fetch_array($select_plans_details_submit);

$get_all_expenses_query = "SELECT * FROM expenses WHERE plan_id = '$plan_id'";
$get_all_expenses_submit = mysqli_query($con, $get_all_expenses_query);
$no_of_expenses = mysqli_num_rows($get_all_expenses_submit);
$get_people_names_query = "SELECT * FROM planusers WHERE plan_id = '$plan_id'";
$get_people_names_submit = mysqli_query($con, $get_people_names_query) or die(mysqli_error($con));
$names = array();
while ($name = mysqli_fetch_array($get_people_names_submit)) {
    $names[$name['id']] = $name['user_name'];
}
$individual_share = $plan_details['amountspent'] / $plan_details['noofpeople'];
?>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="expensedistribution.css" type="text/css">
    <link rel="icon" type="image/png" href="../images/logo">
    <title>Expense Distribution</title>
</head>

<body>
    <?php require '../includes/header_logged_in.html'; ?>
    <div class="container">
    <a href="viewplan.php?plan_id=<?php echo $plan_id;?>"><button class="button"><span class="glyphicon glyphicon-arrow-left"></span>Go to Plan Details</button></a>
        <div class="row">
                <center>
                    <div class="panel panel-primary panelwidth">
                        <div class="panel-heading">
                            <div class="container-fluid">
                                <h4 class="name"><?php echo $plan_details['title']; ?></h4>
                                <h4><span class="glyphicon glyphicon-user value"><?php echo $plan_details['noofpeople'] ?></span></h4>
                            </div>
                        </div>

                        <div class="panel-body">
                            <div class="container-fluid">
                                <h6 class="name"><b>Initial Budget</b></h6>
                                <h6 class="value">₹<?php echo $plan_details['initialbudget']; ?></h6>
                            </div>
                            <?php foreach ($names as $person_id => $person_name) { ?>
                                <div class="container-fluid">
                                    <h6 class="name"><b><?php echo $person_name; ?>: </b></h6>
                                    <h6 class="value">₹<?php echo moneyshare($person_id, $con, $plan_id); ?></h6>
                                </div>
                            <?php } ?>
                            <!--For personal shares-->
                            <div class="container-fluid">
                                <h6 class="name"><b>Total amount spent</b></h6>
                                <h6 class="value">₹<?php echo $plan_details['amountspent']; ?></h6>
                            </div>
                            <div class="container-fluid">
                                <h6 class="name"><b>Remaining amount</b></h6>
                                <?php
                                $reaming_amount =  $plan_details['initialbudget'] - $plan_details['amountspent'];
                                if ($reaming_amount == 0) {
                                    echo "<h6 class='value' style='color:aqua'>Buget all used up</h6>";
                                } else if ($reaming_amount > 0) {
                                    echo "<h6 class='value' style='color:#99FF77'> ₹$reaming_amount </h6>";
                                } else {
                                    echo "<h6 class='value' style='color:red'>Used Additional ₹".(-1*$reaming_amount)."</h6>";
                                }
                                ?>
                            </div>
                            <div class="container-fluid">
                                <h6 class="name"><b>Indivial shares</b></h6>
                                <h6 class="value">₹<?php echo number_format($individual_share,2); ?></h6>
                            </div>
                            <?php foreach ($names as $person_id => $person_name) { ?>
                                <div class="container-fluid">
                                    <h6 class="name"><b><?php echo $person_name; ?>: </b></h6>

                                    <?php
                                    $share = $individual_share - moneyshare($person_id, $con, $plan_id);
                                    if ($share == 0) {
                                        echo "<h6 class='value' style='color:aqua'>All settled up!</h6>";
                                    } else if ($share < 0) {
                                        $share *= -1;
                                        echo "<h6 class='value' style='color:red'>Owes ₹".number_format($share,2)."</h6>";
                                    } else {
                                        echo "<h6 class='value' style='color:#99FF77'>Gets back ₹".number_format($share,2)."</h6>";
                                    }
                                    ?>
                                </div>
                            <?php } ?>
                            <!--For personal shares-->
                        </div>
                    </div>
                </center>
            
        </div>
    </div>
    <?php require '../includes/footer.html'; ?>
</body>

</html>

<?php
function moneyshare($person_id, $con, $plan_id)
{
    $person_spent_query = "SELECT * FROM expenses WHERE plan_id = $plan_id and person_id = $person_id";
    $person_spent_submit = mysqli_query($con, $person_spent_query) or die(mysqli_error($con));
    $total_spent = 0;
    while ($row = mysqli_fetch_array($person_spent_submit)) {
        $total_spent += $row['amountspent'];
    }
    return $total_spent;
}
?>