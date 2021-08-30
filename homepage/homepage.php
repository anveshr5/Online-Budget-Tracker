<?php
session_start();
if (!isset($_SESSION['email'])) {
    header('Location: ../index.php');
}
$con = mysqli_connect("localhost", "root", "", "budgettracker") or die(mysqli_error($con));
$creator_id = $_SESSION['id'];
$select_plans_query = "SELECT * FROM plandetails WHERE creator_id = '$creator_id'";
$select_plans_submit = mysqli_query($con, $select_plans_query) or die(mysqli_error($con));
if (isset($_SESSION['error'])) {
    unset($_SESSION['error']);
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="homepage.css" type="text/css">
    <link rel="icon" type="image/png" href="../images/logo">
    <title>Homepage</title>
</head>

<body>
    <?php require '../includes/header_logged_in.html'; ?>
    <div class="container">
        <?php
        if (mysqli_num_rows($select_plans_submit) != 0) {
        ?>
            <div class="container plans neumorphic variation1">
                <h1>Your Plans!</h1>
            </div>

            <div class="container">
                <div class="row">
                    <?php while ($row = mysqli_fetch_array($select_plans_submit)) { ?>
                        <div class=" col-xs-12 col-sm-6 col-md-6 col-lg-4">
                            <div class="panel panel-primary panelwidth">
                                <div class="panel-heading container-fluid">
                                    <h4 class="name"><?php echo $row['title'] ?></h4>
                                    <h4><span class="glyphicon glyphicon-user value"><?php echo $row['noofpeople'] ?></span></h4>
                                </div>
                                <div class="panel-body">
                                    <div class="container-fluid">
                                        <h6 class="name"><b>Budget</b></h6>
                                        <h6 class="value">₹<?php echo $row['initialbudget'] ?></h6>
                                    </div>
                                    <div class="container-fluid">
                                        <h6 class="name"><b>Date</b></h6>
                                        <h6 class="value"><?php echo $row['fromdate'] ?> to <?php echo $row['todate'] ?></h6>
                                    </div>
                                    <center>
                                        <div class="panel-footer">
                                            <a href="../viewplan/viewplan.php?plan_id=<?php echo $row['id']; ?>"><button class="button">View Plan</button></a>
                                        </div>
                                    </center>
                                </div>
                            </div>
                        </div>
                    <?php } ?>

                    <!-- Empty panel to avoid the add plan '+' from overlapping the plans panels -->
                    <div class=" col-xs-12 col-sm-6 col-md-6 col-lg-4 transparent">
                        <div class="panel transparent">
                            <div class="panel-heading container-fluid transparent">
                                <h4 class="name"></h4>
                                <h4><span></span></h4>
                            </div>
                            <div class="panel-body transparent">
                                <div class="container-fluid">
                                    <h6 class="name"> </h6>
                                    <h6 class="value"> </h6>
                                </div>
                                <div class="container-fluid">
                                    <h6 class="name"> </h6>
                                    <h6 class="value"> </h6>
                                </div>
                                <div class=" transparent">
                                    <a href="#"></a>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
            <br>

        <?php
        } else {
        ?>
            <div class="container">
                <h1>No active plans!</h1>
            </div>
            <a href="../createNewPlan/createNewPlan.php">
                <center class="center">
                    <div class="new-plan">
                        <h2>Create new plan</h2>
                    </div>
                </center>
            </a>
        <?php } ?>
    </div>
    <div class="container">
        <a href="../createNewPlan/createNewPlan.php" class="w-25">
            <section>
                <div class="neumorphic variation1 addpos">
                    <span><strong>+</strong></span>
                </div>
            </section>
        </a>
    </div>
    <?php require '../includes/footer.html'; ?>
</body>

</html>