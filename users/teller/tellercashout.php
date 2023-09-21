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

    <div class="container-fluid">

        <div class="row">
            <div class="col-12 col-lg-9">

                <div class="d-flex flex-column cashout-info">

                    <div class="fw-bold label">
                        CASH OUT
                    </div>

                    <div class="d-flex flex-column wallet-balance">
                        
                        <div class="label-wallet-balance">
                            RUNNING BALANCE
                        </div>
                        <div class="label-amount">
                            <?=$_SESSION['wallet_balance'] ;?>
                        </div>

                    </div>

                    <form id="submit_cashout">
                        <div class="d-flex flex-column justify-content-center w-100 input-amount">
                            <div class="input-group">

                                <div class="label-input">
                                    ENTER AMOUNT:
                                </div>
                                <input type="hidden" name="teller_id" id="teller_id" value="<?=$_SESSION['id']; ?>" class="form-control w-100">
                                <div class="input">
                                    <input type="number" name="amount" id="amount" class="form-control">
                                    <p style="color: red" id="balance_id"></p>
                                </div>

                                <div class="btnamount">
                                    <input type="submit" value="Send" id = "btn_click" class="btn btn-primary">
                                </div>

                            </div>
                        </div>
                    </form>

                    <form id="submit_password" style="display: none">
                        <div class="d-flex flex-column justify-content-center w-100 input-password">

                            <div class="input-group">
                                <div class="label-input">
                                    PLEASE ENTER YOUR PASSWORD:
                                </div>
                                <div class="input_password">
                                    <input type="password" name="password" id="password" class="form-control">
                                    <p style="color: red;" id="balance_id_password"></p>
                                </div>
                                <div class="btnamount">
                                    <input type="submit" value="Proceed" id = "btn_proceed" class="btn btn-primary">
                                </div>
                            </div>

                        </div>
                    </form>

                </div>
                
            </div>
            <div class="col-12 col-lg-3" id="message-info" style="display: nones">

                <div class="success-message">
                    <div class="fw-bold message">
                        Successfully!
                    </div>
                    <img src="../../image/avatar.jpg" alt="profile" class="rounded" >
                    <div class="d-flex flex-column store_name">
                        <small class="store_name_label">Store Name</small>
                        <div class="user_name"><?=$name; ?></div>
                    </div>
                    <hr>
                    <div>Request for Cast Out</div>
                    <b class="amount-cashout"></b>
                    <hr>
                    <div class="date_submit"></div>
                    <p class="ref_number"></p>
                </div>

            </div>
        </div>

    </div>

</body>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.0/jquery.min.js" integrity="sha512-3gJwYpMe3QewGELv8k/BX9vcqhryRdzRMxVfq6ngyWXwo03GFEzjsUm8Q7RZcHPHksttq7/GFoxjCVUjkjvPdw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="https://unpkg.com/sweetalert2@7.8.2/dist/sweetalert2.all.js"></script>
<script src="../../js/tellercashout.js"></script>
</html>
<script>
$("#nav").load('storenav.php'); 

</script>