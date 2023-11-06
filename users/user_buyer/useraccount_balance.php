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
    <link rel="stylesheet" href="../../css/useraccount_balance.css">
    <title>Account Balance</title>
</head>
<body>
    <div id="navbar"></div>
    <div class="content-info">
        <input type="hidden" value="<?=$id ?>" id="user_id">
        <div class="content-label">
            <h1><b>Account Balance</b></h1>
            <p>Non-Bago Fee</p>
        </div>
        <div class="content-userInfo">
            <div class="d-flex flex-column align-items-center userInfo-header">
                <img src="../../image/bcc_logo.png" alt="BCC logo">
                <div class="label-data fw-bold">BAGO CITY COLLEGE | NON BAGO FEE ACCOUNT</div>
                <div class="school-year">
                </div>
            </div>
            <div class="personal-data">
                <div class="name-stundet_id">
                </div>
                <div class="course-year"></div>
                <div class="address"></div>
            </div>
            <div class="balance_label">BALANCE</div>
            <div class="d-flex flex-column gap-2 amount-price w-100 fw-bold">
                <div class="d-flex flex-row justify-content-between non-bago-fee">
                    <div class="nonBago-label">NON BAGO FEE</div>
                    <div class="amount-non-bago"></div>
                </div>
                <div class="line"></div>
                <div class="d-flex flex-row justify-content-between non-bago-fee-total">
                    <div class="nonBago-label-total">TOTAL</div>
                    <div class="amount-non-bago-total"></div>
                </div>
            </div>
            
        </div>
    </div>
</body>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.0/jquery.min.js" integrity="sha512-3gJwYpMe3QewGELv8k/BX9vcqhryRdzRMxVfq6ngyWXwo03GFEzjsUm8Q7RZcHPHksttq7/GFoxjCVUjkjvPdw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment.min.js" crossorigin="anonymous"></script>
<script src="../../js/useraccount_balance.js"></script>
</html>