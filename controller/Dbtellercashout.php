<?php 
require ('Dbconnection.php');
date_default_timezone_set("Asia/Manila"); 
if(isset($_POST['amount'])&&isset($_POST['teller_id'])){
    $amount = $_POST['amount'];
    $teller_id = $_POST['teller_id'];
    try {
        $getwalletbalance = mysqli_query($connect, "SELECT SUM(order_amount) AS wallet_balance FROM `order_tb` WHERE teller_id = '$teller_id' AND statues = 'PROCEED';");
        $walletbalance = mysqli_fetch_assoc($getwalletbalance);
    } catch (\Throwable $th) {
        echo $th;
    }


    $cashout = mysqli_query($connect, "SELECT SUM(cashout_amount) AS cashout FROM `cashout_tb` WHERE teller_id = '$teller_id';") or die(mysqli_error($connect));
    $amount_cashout = mysqli_fetch_assoc($cashout);

    if(!empty($amount_cashout)){
        $wallet_balance = $walletbalance['wallet_balance']-$amount_cashout['cashout'];
    }else{
        $wallet_balance = $walletbalance['wallet_balance']-0;
    }

    if($wallet_balance >= $amount){

        echo "valid";
        
    }else{
        echo "invalid_input";
    }

}

?>