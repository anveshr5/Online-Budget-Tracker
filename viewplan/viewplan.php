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
$remaining_amount = $plan_details['initialbudget'] - $plan_details['amountspent'];
if (isset($_SESSION['error'])) {
    $error = $_SESSION['error'];
    echo "<script>alert('$error')</script>";
    unset($_SESSION['error']);
}
?>

<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="viewplan.css" type="text/css">
    <link rel="icon" type="image/png" href="../images/logo">
    <title>View Plan</title>
</head>

<body>
    <?php include '../includes/header_logged_in.html'; ?>
    <div class="container-fluid bg">
        <div class="container">
            <a href="../homepage/homepage.php"><button class="button"><span class="glyphicon glyphicon-arrow-left"></span>Go to Home</button></a>
            <div class="row">
                <div class="col-xs-12 col-sm-9 col-md-6 col-lg-6 ">
                    <div class="panel panel-primary panelwidth">
                        <div class="panel-heading">
                            <div class="container-fluid">
                                <h4 class="name"><?php echo $plan_details['title']; ?></h4>
                                <h4><span class="glyphicon glyphicon-user value"><?php echo $plan_details['noofpeople'] ?></span></h4>
                            </div>
                        </div>
                        <div class="panel-body">
                            <div class="container-fluid">
                                <h6 class="name"><b>Budget</b></h6>
                                <h6 class="value">₹<?php echo $plan_details['initialbudget'] ?></h6>
                            </div>
                            <div class="container-fluid">
                                <h6 class="name"><b>Remaining amount</b></h6>
                                <?php if ($remaining_amount > 0) { ?>
                                    <h6 class="value" style="color: #99FF55">₹<?php echo  $remaining_amount; ?></h6>
                                <?php } else if ($remaining_amount < 0) { ?>
                                    <h6 class="value" style="color: red">Used Additional ₹<?php echo  $remaining_amount*-1; ?></h6>
                                <?php } else { ?>
                                    <h6 class="value" style="color: red"><?php echo  "Budget used up!"; ?></h6>
                                <?php } ?>
                            </div>
                            <div class="container-fluid">
                                <h6 class="name"><b>Date</b></h6>
                                <h6 class="value"><?php echo $plan_details['fromdate'] . " to " . $plan_details['todate']; ?> </h6>
                            </div>
                        </div>
                    </div>
                </div>
                
                <a href="expensedistribution.php?plan_id=<?php echo $plan_id; ?>"><button class="button extra">Expense Distribution</button></a>
               
                <a href="addexpense.php?plan_id=<?php echo $_GET["plan_id"]; ?>"><button class="button extra">Add Expense</button></a>
                
            </div>
        </div>

        <div class="container">
            <?php if ($no_of_expenses > 0) { ?>
                <div class="container plans neumorphic variation1">
                    <h2>Your Expenses!</h2>
                </div>
                <div class="container">
                    <div class="row">
                        <?php while ($row = mysqli_fetch_array($get_all_expenses_submit)) { ?>
                            <div class="col-xs-12 col-sm-6 col-md-4 col-lg-4">
                                <div class="panel panel-primary panelwidth">
                                    <div class="panel-heading">
                                        <h4><?php echo $row['title'] ?></h4>
                                    </div>
                                    <div class="panel-body">
                                        <div class="container-fluid">
                                            <h6 class="name"><b>Amount spent</b></h6>
                                            <h6 class="value">₹<?php echo $row['amountspent'] ?></h6>
                                        </div>
                                        <div class="container-fluid">
                                            <h6 class="name"><b>Paid by</b></h6>
                                            <h6 class="value"><?php echo $names[$row['person_id']] ?></h6>
                                        </div>
                                        <div class="container-fluid">
                                            <h6 class="name"><b>Paid on</b></h6>
                                            <h6 class="value"><?php echo $row['date'] ?></h6>
                                        </div>
                                        <center>
                                            <?php if ($row['imgname'] != NULL) { ?>
                                                <div class="panel-footer">
                                                    <a href="../bills/<?php echo $row['imgname'] ?>"><button class="button bill">View Bill</button></a>
                                                </div>
                                            <?php } else { ?>
                                                <div class="panel-footer">
                                                    <button class="button nobill" disabled>You don't have a bill</button>
                                                </div>
                                            <?php } ?>
                                        </center>
                                    </div>
                                </div>
                            </div>
                        <?php } ?>

                        <!-- Empty panel to avoid the add plan '+' from overlapping the plans panels -->
                        <div class="col-xs-12 col-sm-6 col-md-4 col-lg-4 transparent" style="margin: 10px">
                            <div class="panel transparent">
                                <div class="panel-heading transparent">
                                    <h4></h4>
                                </div>
                                <div class="panel-body transparent">
                                    <div class="container-fluid">
                                        <h6 class="name"><b> </b></h6>
                                        <h6 class="value"> </h6>
                                    </div>
                                    <div class="container-fluid">
                                        <h6 class="name"><b> </b></h6>
                                        <h6 class="value"> </h6>
                                    </div>
                                    <div class="container-fluid">
                                        <h6 class="name"><b> </b></h6>
                                        <h6 class="value"> </h6>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            <?php } else { ?>
                <div class="container plans neumorphic variation1">
                    <h3><b>No expenses yet!</b></h3>
                </div>
            <?php } ?>
        </div>
    </div>
    <div>
        <a href="addexpense.php?plan_id=<?php echo $_GET["plan_id"]; ?>">
            <section>
                <div class="neumorphic variation1 addpos">
                    <span><strong>+</strong></span>
                </div>
            </section>
        </a>
    </div>
    <?php include '../includes/footer.html'; ?>
</body>

</html>