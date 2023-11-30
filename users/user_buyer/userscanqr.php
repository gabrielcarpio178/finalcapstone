<?php
session_start();
require('../../controller/Dbconnection.php');
if(!isset($_SESSION['id'])&&($_SESSION['usertype']!="student"||$_SESSION['usertype']!="personnel")){
    if(!isset($_SERVER['HTTP_REFERER'])){
        header('location: ../../index.php');
        exit;
   }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Scan QR</title>
    <!-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous"> -->
    <link rel="stylesheet" href="../../fontawesome-free-6.4.2-web/css/fontawesome.css">
    <link rel="stylesheet" href="../../fontawesome-free-6.4.2-web/css/all.css">
    <link rel="stylesheet" href="../../css/all.min.css">
    <link rel="stylesheet" href="../../css/sweetalert2.min.css">
    <link rel="stylesheet" href="../../css/bootstrap.min.css"> 
    <link rel="stylesheet" href="../../css/userscanqr.css"> 
</head>
<body>

    <div id="navbar"></div>

    <div class="d-flex flex-row container-fluid">

        <div class="content-info w-100 mb-5">
            <h1 class="content-label">QR CODE SCAN</h1>
            <div class="input_search_result">
                <input type="text" name="search_canteen" id="search_canteen" class="form-control" placeholder="Search Canteen Store">
                <div class="result">
                </div>
            </div>
            
            
            <div class="demo-btnscan">
                <div class="d-flex flex-row justify-content-around align-items-center qr_instruction">

                    <div class="label_instruction">
                        <img src="../../image/step_1.png" class="instruction_image">
                    </div>

                    <div class="label_instruction">
                        <img src="../../image/step_2.png" class="instruction_image">
                    </div>

                    <div class="label_instruction">
                        <img src="../../image/step_3.png" class="instruction_image">
                    </div>

                    <div class="label_instruction">
                        <img src="../../image/step_4.png" class="instruction_image">
                    </div>

                    <div class="label_instruction">
                        <img src="../../image/step_5.png" class="instruction_image">
                    </div>

                </div>

                <div id="btnscan_qr" class="scan-qr">
                    <img src="../../image/qrcode.png">
                </div>
            </div>

            <main>
                <div id="reader"></div>
            </main>
            <div class="alert alert-dismissible alert-danger" style="display: none">
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                <strong>Invalid Qr</strong>
            </div>

            <div id="result" class="show" style="display: none;">
                <div class="label-input">
                    Canteen Store
                </div>
                <div class="teller-store fw-bold">
                    
                </div>
                <form id="input_balance">
                    <input type="hidden" value="<?=$_SESSION['id'] ?>" class="form-control" name="user_id" id="user_id">
                    <input type="hidden" id="balance_amount">
                    <label for="input-amount">Enter Amount:</label>
                    <div class="peso-sign-input">
                        <div class="peso-sign">₱</div>
                        <input type="number" class="form-control" name="input_amount" id="input_amount">
                    </div>
                    
                    <input type="submit" class="btn btn-primary w-100" value="Send">

                </form>    
            </div>

            <div id="result_password" class="show_passowrd" style="display: none;">
                <div class="label-password">
                    Please enter your password
                </div>
                <div id="input_password_form">
                    <div class="pass-icon">
                        <input type="password" class="form-control mt-3" name="input_password" id="input_password">
                        <div class="icon-pass">
                            <i class="fa-solid fa-eye-slash"></i>
                        </div>
                    </div>
                    
                    <input type="submit" class="btn btn-primary w-100 mt-3" id="submit_password" value="Proceed">
                </div>    
            </div>

        </div>

        <div class="success-message" style="display: none">

            <div class="title-label">
                BCC Digital Payment System           
            </div>
            <div class="icon-success">
                <img src="../../image/sweet_success.jfif" class="sweet_success">
                <b>Success</b>
            </div>
            <div class="teller-label">
                <p>You've successfully sent payment to</p>
                <b id="canteen_staff_name"></b>
            </div>

            <div class="show-amount">
                <div class="data-amount">
                    <p>₱</p>
                    <p class="inserted-amount"></p>
                </div>
                <div class="label-total">
                    Total amount
                </div>
            </div>

            <div class="label-amount">
                <div class="data-show">
                    <p class="label-show">Date and Time:</p>
                    <p id="datetime"></p>
                </div>
                <div class="data-show">
                    <p class="label-show">Reference Number:</p>
                    <p id="ref_num"></p>
                </div>
            </div>
            <div class="btn-ok">
                <button class="btn btn-primary" id="success_okay">Okay</button>
            </div>


        </div>

    </div>
    
</body>
<!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/html5-qrcode/2.3.4/html5-qrcode.min.js" integrity="sha512-k/KAe4Yff9EUdYI5/IAHlwUswqeipP+Cp5qnrsUjTPCgl51La2/JhyyjNciztD7mWNKLSXci48m7cctATKfLlQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.0/jquery.min.js" integrity="sha512-3gJwYpMe3QewGELv8k/BX9vcqhryRdzRMxVfq6ngyWXwo03GFEzjsUm8Q7RZcHPHksttq7/GFoxjCVUjkjvPdw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script> -->
<script src="../../js/html5-qrcode.min.js"></script>
<script src="../../js/jquery.min.js"></script>
<script src="../../js/bootstrap.bundle.min.js"></script>
<script src="../../js/sweetalert2.all.min.js"></script>
<script src="../../js/userscanqr.js"></script>
</html>