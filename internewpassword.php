<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Enter New Password</title>
    <link rel="stylesheet" href="fontawesome-free-6.4.2-web/css/fontawesome.css">
    <link rel="stylesheet" href="fontawesome-free-6.4.2-web/css/all.css">
    <link rel="stylesheet" href="css/all.min.css">
    <link rel="stylesheet" href="css/sweetalert2.min.css">
    <link rel="stylesheet" href="css/bootstrap.min.css" />
    <link rel="stylesheet" href="css/internewpassword.css">
</head>
<body>
    <div class="loader"><img src="image/loader.gif"></div>
    <div class="d-flex flex-column content-info p-5">
        <div class="d-flex flex-row justify-content-between">
            <h2 class="fw-bold">BCC Digital Payment System</h2>
            <i class="fa-solid fa-x"></i>
        </div>

        <div class="d-flex flex-column justify-content-center align-items-center form-logo">
            <div class="form-content">
                <form id="submit_form">
                    <h2 class="fw-bold text-center">Enter New Password</h2>
                    <div class="form_input">
                        <input type="password" id="new_password" class="form-control" minLength="10">
                        <i class="fa-solid fa-eye-slash eye" id="new_eye_icon"></i>
                    </div>
                    <p class="new_message">Must be at least 10 characters</p>
                    <div class="form_input">
                        <input type="password" id="confirm_password" class="form-control" minLength="10">
                        <i class="fa-solid fa-eye-slash eye" id="con_eye_icon"></i>
                    </div>
                    <p class="con_message">Both password must match</p>
                    <button class="btn btn-primary w-100">UPDATE PASSWORD</button>
                </form>
            </div>
        </div>

    </div>
</body>
<script src="js/jquery.min.js"></script>
<script src="js/sweetalert2.all.min.js"></script>
<script src="js/bootstrap.bundle.min.js"></script>
<script src="js/internewpassword.js"></script>
</html>