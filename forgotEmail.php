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
    <link rel="stylesheet" href="css/forgotEmail.css">
    <title>Forgot Password</title>
</head>
<body>
    <div class="loader"><img src="image/loader.gif"></div>
    <div class="d-flex flex-column content-info p-5">
        <div class="d-flex flex-row justify-content-between">
            <h2 class="fw-bold">BCC Digital Payment System</h2>
            <i class="fa-solid fa-x"></i>
        </div>

        <div class="d-flex flex-column justify-content-center align-items-center form-logo">
            <img src="image/email_forgot.png" alt="forgot_logo">
            <h2 class="fw-bold">Forgot Password</h2>
            <p>A verification code will be sent to the email address associated with your Technopal account.</p>
        </div>

        <div class="form_forgot">
            <form id="form_submit">
                <label for="email">Email</label>
                <input type="email" class="form-control" id="email">
                <button class="btn btn-primary w-100">SEND</button>
            </form>
        </div>
    </div>
</body>
<script src="js/jquery.min.js"></script>
<script src="js/forgotEmail.js"></script>
<script src="js/sweetalert2.all.min.js"></script>
<script src="js/bootstrap.bundle.min.js"></script>
</html>