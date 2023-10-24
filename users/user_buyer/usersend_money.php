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
    <title>Send Money</title>
</head>
<body>
    <div id="navbar"></div>
    <input type="hidden" name="" id="user_id" value="<?=$id ?>">
    <div class="content-data">
        <div class="row">
            <div class="col-12" id="containner_content">
                <div class="content-info">
                    <div class="d-flex flex-row justify-content-between header-content">
                        <div class="d-flex flex-column content-label">
                            <div class="label-info fw-bold">
                                Send Money
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
                <div class="d-flex flex-column p-4 user-profile">
                    <p>Profile</p>
                    <div class="d-flex flex-column align-items-center profile-name">
                        <img src="../../image/avatar.jpg" alt="">
                        <h2 class="user-name mt-4"></h2>
                        <div class="d-flex flex-row user-info">
                            <div class="user-info-label">
                                STUDENT ID:
                            </div>
                            <div class="user-id">
                                
                            </div>
                        </div>
                        <div class="user_type">
                            
                        </div>
                    </div>
                    <div class="d-flex flex-column data-info">
                        <div class="label-content">
                            Department:
                        </div>
                        <div class="label-data" id="department"></div>
                    </div>
                    <div class="d-flex flex-column data-info">
                        <div class="label-content">
                            Phone Number:
                        </div>
                        <div class="label-data" id="pnumber"></div>
                    </div>
                    <div class="d-flex flex-column data-info">
                        <div class="label-content">
                            Address
                        </div>
                        <div class="label-data" id="address"></div>
                    </div>
                    <center>
                        <button class="btn btn-danger w-25 mt-3" id="btn_cancel">Cancel</button>
                    </center>
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