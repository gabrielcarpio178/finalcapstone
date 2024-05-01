<?php
session_start();
require('../../controller/Dbconnection.php');
if(($_SESSION['usertype']!="teller")){
    if(!isset($_SERVER['HTTP_REFERER'])){
        header('location: ../../index.php');
        exit;
    }
}

$teller_id = $_SESSION['id'];
// total_collection
$collection = mysqli_query($connect, "SELECT SUM(order_amount) AS total_amount FROM order_tb WHERE statues = 'PROCEED' AND teller_id = '$teller_id' AND CAST(deadline_time AS DATE) LIKE CURRENT_DATE() GROUP BY CAST(deadline_time AS DATE);") or die(mysqli_error($connect));
$total_collection = mysqli_fetch_assoc($collection);

//total wallet balance
$wallet_balance = mysqli_query($connect, "SELECT SUM(order_amount) AS wallet_balance FROM `order_tb` WHERE teller_id = '$teller_id' AND statues = 'PROCEED';") or die(mysqli_error($connect));
$total_balance = mysqli_fetch_assoc($wallet_balance);

$cashout = mysqli_query($connect, "SELECT SUM(cashout_amount) AS cashout FROM `cashout_tb` WHERE teller_id = '$teller_id';") or die(mysqli_error($connect));
$amount_cashout = mysqli_fetch_assoc($cashout);


if(!empty($amount_cashout)){
    $_SESSION['wallet_balance'] = $total_balance['wallet_balance']-$amount_cashout['cashout'];
}else{
    $_SESSION['wallet_balance'] = $total_balance['wallet_balance']-0;
}


?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<!-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" /> -->
<link rel="stylesheet" href="../../fontawesome-free-6.4.2-web/css/fontawesome.css">
<link rel="stylesheet" href="../../fontawesome-free-6.4.2-web/css/all.css">
<link rel="stylesheet" href="../../css/all.min.css">
<link rel="stylesheet" href="../../css/sweetalert2.min.css">
<link rel="stylesheet" href="../../css/bootstrap.min.css">
<link rel="stylesheet" href="../../css/tellerhomepage.css">
    <title>Home page</title>
</head>
<body>
    <div id="nav"></div>   
    <div class="container-fluid">
        <div class="row home-info">
            
            <div class="col-12 col-lg-8 gx-3">
                
                <div class="d-flex flex-column content-info">
                    
                    <div class="d-flex flex-row justify-content-between align-items-center w-100 header-content">
                        <b class="home z-">HOME</b>
                        <div class="count_noti z-">
                            <div class="num_noti"></div>
                            <i class="fa-solid fa-bell" id="btn_bell"></i>
                        </div>
                        <div id="noti_content" class="d-flex flex-column p-1 noti-content" style="display: none !important;">
                            <div class="noti-info h-100">

                            </div>
                            <div class="btn-clear w-100 text-center" id="btn_clear">
                                Mark All as Read
                            </div>
                        </div>
                    </div>
                    <div class="d-flex flex-row justify-content-between announcement mt-3">
                        <div class="d-flex flex-column justify-content-end w-100 message">
                            <b class="welcome"></b> 
                            <div class="announce-info">
                                BCC Digital Payment System
                            </div>                         
                        </div>
                        <img src="../../image/icon_1.png" alt="Logo" class="logo">
                        
                    </div>
                    
                    <div class="d-flex flex-row justify-content-around menus">
                        
                        <div class="menu" id="order-teller">
                            <img src="../../image/order.png">
                            <p>Order</p>    
                        </div>
                        <div class="menu" id="menu-teller">
                            <img src="../../image/menu.png"> 
                            <p>Menu</p>   
                        </div>
                        <div class="menu" id="cash_out">
                            <img src="../../image/cashout.png">
                            <p style="white-space: nowrap;">Cash Out</p>        
                        </div>
                        
                    </div>

                    <a href="../../pdf.php?teller_id=<?=$teller_id; ?>" class="btn btn-warning mt-5" target=”_blank”><i class="fa fa-upload"></i>View QR</a>
                    
                </div>
                
            </div>
            
            <div class="col-12 col-lg-4 teller-info p-4">
                
                <div class="wallet-balance">
                    <b class="wallet-label text-label-category">RUNNING BALANCE</b>
                    <div class="balance-amount amount-data"><?=(!empty($total_balance['wallet_balance']))? "₱".sprintf("%1\$.2f", $_SESSION['wallet_balance']):"₱0" ?></div>
                </div>
                
                <div class="collection">
                    <b class="collection-label text-label-category">DAILY COLLECTION</b>
                    <div class="collection-balance amount-data"><?=(!empty($total_collection['total_amount']))? "₱".sprintf("%1\$.2f", $total_collection['total_amount']): "₱0" ?></div>
                    <div id="date" class="current-date"></div>
                </div>
                
                <div class="d-flex flex-column align-items-center summary-income p-lg-3">
                    <b class="summart-label text-label-category">STORE PERFORMANCE</b>
                    <img src="../../image/shop_performance.png" id="graph_image">
            </div>
        </div>
        
    </div>
</div>                  
</body>
<!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.0/jquery.min.js" integrity="sha512-3gJwYpMe3QewGELv8k/BX9vcqhryRdzRMxVfq6ngyWXwo03GFEzjsUm8Q7RZcHPHksttq7/GFoxjCVUjkjvPdw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="https://unpkg.com/sweetalert2@7.8.2/dist/sweetalert2.all.js"></script> -->
<script src="../../js/jquery.min.js"></script>
<script src="../../js/bootstrap.bundle.min.js"></script>
<script src="../../js/sweetalert2.all.min.js"></script>
<script src="../../js/tellerhomepage.js"></script>
</html>
