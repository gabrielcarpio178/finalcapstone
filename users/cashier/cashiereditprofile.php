<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile</title>
        <!-- <link
        rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css"
        integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw=="
        crossorigin="anonymous"
        referrerpolicy="no-referrer"
    /> -->
    <link rel="stylesheet" href="../../fontawesome-free-6.4.2-web/css/fontawesome.css">
    <link rel="stylesheet" href="../../fontawesome-free-6.4.2-web/css/all.css">
    <link rel="stylesheet" href="../../css/all.min.css">
    <link rel="stylesheet" href="../../css/interfont.css">
    <link rel="stylesheet" href="../../css/sweetalert2.min.css">
    <link rel="stylesheet" href="../../css/bootstrap.min.css" />
    <link rel="stylesheet" href="../../css/cashierprofile.css">
</head>
<body>
    <div id="nav"></div>
    <div class="content-data">
        <h2>PROFILE</h2>
        <div class="content-info">
            <div class="profile-content">
                <form id="cashier_info_form">
                    <div class="row p-2">
                        <div class="d-flex flex-row gap-2 col-4 profile-image">
                            <div id="edit_icon">
                                <i class="fas fa-edit"></i>
                            </div>
                            <img src="../../image/avatar.jpg" alt="">
                        </div>
                        <div class="d-flex flex-column justify-content-center align-items-center col-8">
                            <div class="d-flex flex-row justify-content-center cashier-name fw-bold">

                            </div>
                            <div class="cashier-label">
                                Cashier
                            </div>
                        </div>
                    </div>
                    <div class="row-second">
                        <div class="row">
                            <div class="input-content d-flex flex-column text-center col-6">
                                <label for="gender">Gender</label>
                                <select name="gender" id="gender" class="form-select text-center" disabled>
                                    <option value="MALE" id="male">MALE</option>
                                    <option value="FEMALE" id="female">FEMALE</option>
                                </select>
                            </div>
                            <div class="input-content d-flex flex-column text-center col-6">
                                <label for="phone_number">Phone Number</label>
                                <input type="number" id="phone_number" class="form-control text-center" disabled>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12 text-center">
                                <label for="email">Email</label>
                                <input type="email" name="email" id="email" class="form-control text-center" disabled>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12 text-center">
                                <label for="address">Address</label>
                                <input type="text" name="address" id="address" class="form-control text-center" disabled>
                            </div>
                        </div>
                        <button value="submit" id="btn_save" style="display: none;">hidden</button>
                    </div>
                </form>
            </div>   
            <button class="btn btn-primary w-100 mt-2" id="change_pass">Change Password</button>
            <div class="change-password">
                <form id="change_password" class="d-flex flex-column gap-1 mt-1">
                    <div class="d-flex flex-row justify-content-between">
                        <label for="old_password">Old Password</label>
                        <input type="password" name="old_password" id="old_password" class="form-control text-center w-50">
                    </div>
                    <div class="d-flex flex-row justify-content-between">
                        <label for="new_password">New Password</label>
                        <input type="password" name="new_password" id="new_password" class="form-control text-center w-50">
                    </div>
                    <div class="text-end message-length">
                        <div class="message-p"></div>
                    </div>
                    <div class="d-flex flex-row justify-content-between">
                        <label for="confirm_password">Confirm Password</label>
                        <input type="password" name="confirm_password" id="confirm_password" class="form-control text-center w-50">
                    </div>
                    <div class="text-end confirm-length">
                        <div class="confirm-message"></div>
                    </div>
                    <center>
                        <button value="submit" class="btn btn-primary mt-1 w-25">SUBMIT</button>
                    </center>
                </form>
            </div>
        </div>
    </div>

</body>
<!-- <script
    src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.0/jquery.min.js"
    integrity="sha512-3gJwYpMe3QewGELv8k/BX9vcqhryRdzRMxVfq6ngyWXwo03GFEzjsUm8Q7RZcHPHksttq7/GFoxjCVUjkjvPdw=="
    crossorigin="anonymous"
    referrerpolicy="no-referrer"
    ></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>  -->
<script src="../../js/jquery.min.js"></script>
<script src="../../js/sweetalert2.all.min.js"></script>
<script src="../../js/bootstrap.min.js"></script>
<script src="../../js/bootstrap.bundle.min.js"></script>
<script src="../../js/cashierprofile.js"></script>
</html>