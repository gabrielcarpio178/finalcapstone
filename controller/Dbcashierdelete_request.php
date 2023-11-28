<?php
require('Dbconnection.php');
sleep(1);
if(isset($_POST['payment_id'])&&isset($_POST['isCashout'])){
    $payment_id = $_POST['payment_id'];
    $cashout = filter_var($_POST['isCashout'], FILTER_VALIDATE_BOOLEAN);
    if($cashout==false){
        try {
            mysqli_query($connect,"UPDATE `digitalpayment_tb` SET `request_noti`='0',`requestType`='cancel' WHERE  `digitalPayment_id` = '$payment_id';");
            echo "success";
        } catch (\Throwable $th) {
            echo $th;
        }
    }elseif($cashout==true){
        try {
            mysqli_query($connect,"DELETE FROM `cashout_tb` WHERE `cashout_id` = '$payment_id';");
            echo "success";
        } catch (\Throwable $th) {
            echo $th;
        }
    }
}
?>