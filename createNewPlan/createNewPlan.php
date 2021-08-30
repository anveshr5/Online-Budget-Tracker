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
    <title>Create new plan</title>
</head>

<body>
    <?php require "../includes/header_logged_in.html"; ?>
    <div class="container">
        <div class="panel panel-primary panelwidth">
            <div class="panel-heading">
                <h4><b>Create New Plan</b></h4>
            </div>
            <div class="panel-body">
                <form method="get" action="planDetails.php">
                    <div class="form-group">
                        <label>Initial Budget</label>
                        <div class="form-group">
                            <input type="number" placeholder="Initial Budget" class="form-control" name="initialBudget" min=1 required 
                            value="<?php if(!empty($error)) echo $_GET['initialBudget']; ?>">
                        </div>
                        <label>How many people do you want to add in your group?</label>
                        <div class="form-group">
                            <input type="number" value="<?php if(!empty($error)) echo $_GET['noOfPeople']; ?>"  placeholder="No. of People" class="form-control" name="noOfPeople" min=1 required>
                        </div>
                        <center>
                            <div class="form-group">
                                <input type="submit" value="Next" class="button" name="next" placeholder="name">
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

</html>