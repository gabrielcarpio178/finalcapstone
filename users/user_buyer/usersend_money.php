<?php
session_start();
require('../../controller/Dbconnection.php');
if(!isset($_SESSION['id'])&&($_SESSION['usertype']!="student"||$_SESSION['usertype']!="personnel")){
    if(!isset($_SERVER['HTTP_REFERER'])){
        header('location: ../../index.php');
        exit;
    }
}
$id = $_SESSION['id'];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <link rel="stylesheet" href="../../css/bootstrap.min.css"> 
    <link rel="stylesheet" href="../../css/usersend_money.css">
    <title>Transfer Funds</title>
</head>
<body>
    <div id="navbar"></div>
    <input type="hidden" name="" id="user_id" value="<?=$id ?>">
    <div class="content-data">
        <div class="row">
            <div class="col-12" id="containner_content">
                <div class="content-info">
                    <div class="d-flex flex-column flex-lg-row justify-content-between header-content">
                        <div class="d-flex flex-column content-label">
                            <div class="label-info fw-bold text-nowrap">
                                Transfer Funds
                            </div>
                            <p>Send money to other user's account</p>
                        </div>
                        <div class="d-flex flex-column align-items-center justify-content-center wallet-balance">
                            <div class="align-self-start balance-label">
                                Wallet Balance
                            </div>
                            <div class="balance-amount">

                            </div>
                        </div>
                    </div>
                    <div class="d-flex flex-row align-items-center justify-content-center form-content">

                        <div class="form-input">
                            <!-- forms -->
                        </div>

                    </div>
                </div>
            </div>
            <div class="col-4 profile-content" style="display: none">
                <!-- info_data -->
            </div>
        </div>
    </div>   
    <button type="button" style="display: none;" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#insert_pass" id="show_modal">
        hidden
    </button>

    <!-- modal password -->
    <div class="modal fade" id="insert_pass" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-body">
                    <form id="submit_password">
                        <p class="inputpass-label text-center">Please enter your password</p>
                        <div class="d-flex flex-column gap-2 submit_pass_content p-1">
                            <div class="insert_form">
                                <center><input type="password" id="insert_password" class="form-control"></center>
                                <i class="fa-solid fa-eye-slash" id="eye-icon" onclick="showHidePass()"></i>
                            </div>
                            <button type="submit" class="btn btn-primary w-100">Okay</button>
                            
                        </div>
                    </form>
                    <button style="display: none;" id="close_modal" data-bs-dismiss="modal" aria-label="Close">close</button>
                </div>
            </div>
        </div>
    </div>
    
</body>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.0/jquery.min.js" integrity="sha512-3gJwYpMe3QewGELv8k/BX9vcqhryRdzRMxVfq6ngyWXwo03GFEzjsUm8Q7RZcHPHksttq7/GFoxjCVUjkjvPdw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script> 
<script src="../../js/usersend_money.js"></script>
</html>