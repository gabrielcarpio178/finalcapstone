<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="fontawesome-free-6.4.2-web/css/fontawesome.css">
    <link rel="stylesheet" href="fontawesome-free-6.4.2-web/css/all.css">
    <link rel="stylesheet" href="css/all.min.css">
    <link rel="stylesheet" href="css/sweetalert2.min.css">
    <link rel="stylesheet" href="css/bootstrap.min.css" />
    <link rel="stylesheet" href="css/verificationcode.css">
    <title>Verification Code</title>
</head>
<body>
    <div class="d-flex flex-column content-info p-5">
        <div class="d-flex flex-row justify-content-between">
            <h2 class="fw-bold">BCC Digital Payment System</h2>
            <i class="fa-solid fa-x"></i>
        </div>

        <div class="d-flex flex-column justify-content-center align-items-center form-logo">
            <img src="image/verification.png" alt="forgot_logo">
            <h2 class="fw-bold">Verification Code</h2>
            <p>Please enter verification code sent to <?=$_SESSION['email_to'] ?></p>
        </div>

        <div class="form_forgot">
            <form id="form_submit">
                <input type="number" class="form-control" id="number_reset">
                <button class="btn btn-primary w-100">VERIFY</button>
                <p class="text-center">Did not get the code? <span>Re-send</span></p>
            </form>
        </div>

    </div>
</body>
<script src="js/jquery.min.js"></script>
<script src="js/sweetalert2.all.min.js"></script>
<script src="js/bootstrap.bundle.min.js"></script>
<script src="js/verificationcode.js"></script>
</html>