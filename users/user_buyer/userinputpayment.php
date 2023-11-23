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
    <link rel="stylesheet" href="../../css/userinputpayment.css"> 
    <title>Request Payment</title>
</head>
<body>

    <div id="navbar"></div>
    
    <div class="content-info">
        <input type="hidden" name="user_id" id="user_id" value="<?=$id; ?>">
        <div class="label">
            <div class="label-content">
                <h1>REQUEST PAYMENT</h1>
                <p>Choose Type of Payment Method</p>
            </div>
            <div class="wallet-balance">
                <p>Wallet Balance</p>
                <b id="walllet_balance"></b>     
            </div>
        </div>

        <div class="info">

            <div class="method">

                <div class="payment-method">
                    <div class="payment" id="non_bago">
                        <div class="non-bago-color"></div>
                        <div class="category_1"></div>
                    </div>

                    <div class="d-flex flex-column cert-data">
                        <div class="payment" id="cert_e">
                            <div class="cert_e-color"></div>
                            <div class="d-flex flex-row justify-content-between certificate_content">
                                <div>Certifications</div>
                                <div id="show_certificate">
                                    <i class="fa-solid fa-angle-down icon-font"></i>
                                </div>
                            </div>               
                        </div>
                        <div class="d-flex flex-row justify-content-between available-certificate w-75" style="display: none !important;" id="available_display">
                            <div></div>
                            <div class="d-flex flex-column justify-content-end text-start certificate-label">
                                <div class="d-flex flex-column available-data">

                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <div class="payment" id="cert_t">
                        <div class="cert_t-color"></div>
                        <div>Transcript of Records</div>
                    </div>
                </div>

            </div>
            <input type="hidden" id="available_balance">
            <div class="forms-method">
                
            </div>

            <div class="sumbit_password">
            </div>
            
        </div>

        <div class="success-message">
            <div class="title-name">
                BCC Digital Payment System
            </div>
            <div class="success-icon">
                <div class="success-image"><img src="../../image/succes-icon.png"></div>
                <div class="success-label">Success</div>
            </div>
            <div class="message-succes">
                <div class="info-message">You've successfully sent a payment for</div>
                <div class="type-of-payment"></div>
            </div>
            <div class="amount-pament">
                <div class="amount-peso">
                    <div class="peso-sign">₱</div>
                    <div class="payment-total"></div>
                </div>
                <div class="total-payemnt">Total Payment</div>
            </div>
            <div class="payment-info">
                <div class="date-payment">
                    <div class="date-label">Date And Time: </div>
                    <div class="date"></div>
                </div>
                <div class="ref-no mt-3">
                    <div class="ref-label">Reference Number: </div>
                    <div class="ref"></div>
                </div>
            </div>
            <div class="btn-ok mt-4">
                <button class="btn btn-primary w-100" id="btn-ok">OK</button>
            </div>
        </div>

    </div>
    
</body>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.0/jquery.min.js" integrity="sha512-3gJwYpMe3QewGELv8k/BX9vcqhryRdzRMxVfq6ngyWXwo03GFEzjsUm8Q7RZcHPHksttq7/GFoxjCVUjkjvPdw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="../../js/userinputpayment.js"></script>
</html>