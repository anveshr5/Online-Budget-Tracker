<?php
session_start();
if (!isset($_SESSION['email'])) {
    header('location: ../index.php');
}
if (isset($_SESSION['error'])) {
    $error = $_SESSION['error'];
    echo "<script>alert('$error');</script>";
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
    <link rel="stylesheet" href="createNewPlan.css" type="text/css">
    <link rel="icon" type="image/png" href="../images/logo">
    <title>Add new Plan</title>
</head>

<body>
    <?php require "../includes/header_logged_in.html"; ?>
    <div class="container">
        <div class="row">
            <a href="createNewPlan.php"><button class="button goback"><span class="glyphicon glyphicon-arrow-left"></span> Go to Create Plan</button></a>
        </div>
        <div class="panel panel-primary panelwidth">
            <div class="panel-heading">
                <h4>Add plan details</h4>
            </div>
            <div class="panel-body">
                <form method="post" action="add_plan_script.php">
                    <div class="form-group">
                        <label>Title</label>
                        <div class="form-group">
                            <input type="text" placeholder="Title" class="form-control" name="title" required>
                        </div>
                        <label>Starting from</label>
                        <div class="form-group">
                            <input type="date" placeholder="From Date" class="form-control" name="fromDate" required>
                        </div>
                        <label>Ending on</label>
                        <div class="form-group">
                            <input type="date" placeholder="Last Date" class="form-control" name="toDate" required>
                        </div>
                        <label>Initial Budget</label>
                        <div class="form-group">
                            <input type="number" value="<?php echo $_GET['initialBudget'] ?>" class="form-control" name="initialBudget" min=1 readonly>
                        </div>
                        <label>No.of People</label>
                        <div class="form-group">
                            <input type="number" value="<?php echo $_GET['noOfPeople'] ?>" min=1 class="form-control" name="noOfPeople" readonly>
                        </div>
                        <?php for ($i = 1; $i <= $_GET['noOfPeople']; $i++) { ?>
                            <label>Person <?php echo $i; ?></label>
                            <div class="form-group">
                                <input type="text" value="<?php if ($i == 1) echo $_SESSION['name']; ?>" class="form-control" name="person<?php echo $i; ?>" required>
                            </div>
                        <?php } ?>
                        <center>
                            <div class="form-group">
                                <input type="submit" value="Confirm Plan" class="button" name="next" placeholder="name">
                            </div>
                        </center>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <?php require "../includes/footer.html"; ?>
</body>

</html>