<?php
session_start();
?>
<!DOCTYPE html>
<html>

<head>
    <title>About Us</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="aboutus.css" type="text/css">
    <link rel="icon" type="image/png" href="../images/logo">
</head>

<body>
    <?php
    if (isset($_SESSION['email'])) {
        require '../includes/header_logged_in.html';
    } else {
        require '../includes/header_logged_out.html';
    }

    ?>
    <div class="container-fluid">
        <div style="background-color: #516B8C" class="row">
            <div class="textleft">
                <h2><b>An intuitive and cross-platform finance app</b></h2>
                <h4>Access our platform anytime anywhere! Create separate plans for different needs!</h4>
                <h3><b>On-the-go financial clarity</b></h3>
                <h4>Highlights of your recent spending and budget to give you a clear picture of your finances anywhere, anytime.</h4>
            </div>
            <center>
                <div class="imageright">
                    <img src="../images/mockuper_laptop_phone" alt="Site preview" class="thumbnail">
                </div>
            </center>
        </div>
        <div style="background-color: #D9B341" class="row">
            <div class="textright">
                <h2><b>Gain Total Control of Your Money</b></h2>
                <h4>Stop living paycheck-to-paycheck, get out of debt, and save more money.</h4>
                <h3><b>Track your progress</b></h3>
                <h4>Over, under or on budget - keep up with your progress on-the-go with Wally's budget trackers.</h4>

            </div>
            <center>
                <div class="imageleft">
                    <img src="../images/paycheck" alt="Site preview" class="thumbnail">
                </div>
            </center>
        </div>
        <div style="background-color: #516B8C" class="row">
            <div class="textleft">
                <h2><b>Stay organized</b></h2>
                <h4>Save time and money with handy tools that keep your financial life organized.</h4>
                <h3><b>A safe haven for all your important documents</b></h3>
                <h4>Never find the right bill at the right time? Scan & upload bills, receipts and warranties so they're always with you.</h4>
            </div>
            <center>
                <div class="imageright">
                    <img src="../images/bills_organised" alt="Site preview" class="thumbnail">
                </div>
            </center>
        </div>
        <div style="background-color: #D9B341" class="row">
            <div class="textright">
                <h2><b>Financial clarity and control</b></h2>
                <h4>Let Balance take the anxiety and hassle out of managing your finances.</h4>
                <h3><b>On-the-go financial clarity</b></h3>
                <h4>Highlights of your recent spending, budget, and upcoming transactions give you a clear picture of your finances anywhere, anytime.</h4>
            </div>
            <center>
                <div class="imageleft">
                    <img src="../images/financecontrol" alt="Site preview" class="thumbnail">
                </div>
            </center>
        </div>
    </div>
    <?php require '../includes/footer.html' ?>
</body>

</html>