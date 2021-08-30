<?php
session_start();
if (!isset($_SESSION['email'])) {
    header('Location: index.php');
}
$con = mysqli_connect("localhost","root","","budgettracker") or die(mysqli_error($con));
$plan_id = $_GET['plan_id'];
$plans_details_query = "SELECT * FROM plandetails WHERE id=$plan_id";
$plans_details_submit = mysqli_query($con,$plans_details_query) or die(mysqli_error($con));
$plan_details = mysqli_fetch_array($plans_details_submit);
$select_plan_users_query = "SELECT * FROM planusers WHERE plan_id = '$plan_id'";
$select_plan_users_submit = mysqli_query($con,$select_plan_users_query) or die(mysqli_error($con));
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
    <link rel="stylesheet" href="addexpense.css" type="text/css">
    <link rel="icon" type="image/png" href="../images/logo">
    <title>Add expense</title>
</head>

<body>
    <?php require '../includes/header_logged_in.html' ?>
    <div class="container">
        <div class="panel panel-primary panelwidth">
            <div class="panel-heading">
                <h4>Add New Expense</h4>
            </div>
            <div class="panel-body">
                <form method="post" action="add_expense_script.php?plan_id=<?php echo $plan_id;?>" enctype="multipart/form-data">
                    <div class="form-group">
                        <label>Title</label>
                        <div class="form-group">
                            <input type="text" placeholder= "Title" class="form-control" name="title" required>
                        </div>
                        <label>Date Spent on</label>
                        <div class="form-group">
                            <input type="date" class="form-control" name="date" min='<?php echo $plan_details['fromdate'];?>' max='<?php echo$plan_details['todate'];?>' required>
                        </div>
                        <label>Amount Spent</label>
                        <div class="form-group">
                            <input type="number" placeholder="Amount Spent" min=1 class="form-control" name="amountspent" required>
                        </div>
                        <label>Drop down choose people</label>
                        <div class="form-group">
                            <select name="person" id="people" style="color: black">
                                <?php while ($user = mysqli_fetch_array($select_plan_users_submit)){ ?>
                                    <option class ="option" value="<?php echo $user['id']?>"><?php echo $user['user_name']?></option>
                                <?php } ?> 
                            </select>
                        </div>
                        <label>Upload bill image</label>
                        <div class="form-group">
                            <input type="file" class="simple_class" name="uploadedimage">
                        </div>
                        <div class="form-group">
                            <input type="submit" value="submit" class="btn btn-primary btn-block" name="submit" placeholder="name">
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <?php include '../includes/footer.html'; ?>
</body>

</html>