<?php 
session_start();
require('../../controller/Dbconnection.php');
if(($_SESSION['usertype']!="teller")){
    if(!isset($_SERVER['HTTP_REFERER'])){
        header('location: ../../index.php');
    exit;
    }
}
$name = $_SESSION['teller_name'];
$teller_id = $_SESSION['id'];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="../../css/bootstrap.min.css">
    <link rel="stylesheet" href="../../css/tellercashout.css">
    <title>Cash out</title>
</head>
<body>
    <div id="nav"></div>
    <input type="hidden" name="teller_id"  id="teller_id" value="<?=$teller_id ?>">
    <div class="content-info">
        <div class="row">
            <!-- col-lg-8 -->
            <div class="col-12 col-lg-12" id="main-content">
                <div class="cashout-info">

                    <div class="fw-bold label">
                        CASH OUT
                    </div>
                    <div class="wallet-balance">    
                        <div class="label-wallet-balance">
                            RUNNING BALANCE
                        </div>
                        <div class="d-flex flex-row label-amount">
                            <div class="peso-sign">₱</div>
                            <div class="amount"></div>
                        </div>
                    </div>
                    <div class="forms-input mt-5">

                        <div class="input-amount">

                        </div>

                        <div class="input-password" style="display: none">

                        </div>

                    </div>

                </div>    
            </div>
            <div class="col-12 col-lg-4" id="message-info" style="display: none">
                <div class="title-message">
                    BCC Digital Payment System
                </div>
                <div class="icon-success">
                    <img src="../../image/succes-icon.png">
                    <div class="success-label">Success</div>
                </div>
                <div class="message-success">
                    <div class="message">
                        You've successfully sent request to
                    </div>
                    <div class="type-request">
                        Cash Out.
                    </div>
                </div>
                <div class="amount-info">
                    <div class="d-flex flex-row justify-content-center amount-req">
                        <div class="amount-sign">₱</div>
                        <div class="amount-input"></div>
                    </div>
                    <div class="amount-label">
                        Total Amount
                    </div>
                </div>
                <div class="info-generate">
                    <div class="date_submit">
                        <div class="date-label">Date & Time:</div>
                        <div class="date"></div>
                    </div>
                    <div class="ref_number">
                        <div class="ref-label">Reference #:</div>
                        <div class="ref"></div>
                    </div>
                </div>
                <div class="system-message mt-2">
                    <p>
                        Please proceed to Cashier's Office to </br>Cash Out.
                    </p>
                </div>
                <div class="btn-class w-100 mt-2">
                    <button class="btn btn-primary w-100" id="btn_ok">OK</button>
                </div>
            </div> 
        </div>
    </div>

</body>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.0/jquery.min.js" integrity="sha512-3gJwYpMe3QewGELv8k/BX9vcqhryRdzRMxVfq6ngyWXwo03GFEzjsUm8Q7RZcHPHksttq7/GFoxjCVUjkjvPdw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="https://unpkg.com/sweetalert2@7.8.2/dist/sweetalert2.all.js"></script>
<script src="../../js/tellercashout.js"></script>
</html>