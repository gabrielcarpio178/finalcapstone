<?php
require('Dbconnection.php');
if(isset($_POST['payment_id'])&&isset($_POST['cashout'])){
    $payment_id = $_POST['payment_id'];
    $cashout = filter_var($_POST['cashout'], FILTER_VALIDATE_BOOLEAN);
    if($cashout==false){
        try {
            mysqli_query($connect,"UPDATE `digitalpayment_tb` SET `requestType`='accepted' WHERE `digitalPayment_id` = '$payment_id';");
            echo "success";
        } catch (\Throwable $th) {
            echo $th;
        }
    }
}
?>